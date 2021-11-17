<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Mail;
use App\Http\Controllers\Helper;
use App\Mail\LostPasswordMail;

use App\Models\User;

class AuthController extends Controller
{
    public function Login(){
        
        //Login
        if (Auth::check())
            return redirect()->route("home");
        else
            return view("Auth.Login");;
    }

    public function LoginAttempt(Request $request){
        //0. reCaptcha ellenőrzés
        if ( !Helper::checkRecapctha($request->reCaptchaToken) )
            return back()
                ->withErrors("Captcha hiba. Próbáld újra!")
                ->withInput();
        //1.login
        $email = $request->email;
        $password = $request->password;
        $credentials = $request->only(["email", "password"]);
        
       if( Auth::attempt($credentials)){
            return redirect()->route("home");
       }
       else{
            return back()
                ->withErrors("Hibás felhasználónév vagy jelszó!")
                ->withInput();
        }
    }
    public function LogOut(){
        Auth::logout();
        return redirect()->route("home");
    }
    public function Regist(){
        return view("Auth.Regist");
    }
    
    public function LostPassword(){
        return view("Auth.LostPassword");
    }

    public function SendLostPassword(Request $request)
    {
        //0. reCaptcha ellenőrzés
        if ( !Helper::checkRecapctha($request->reCaptchaToken) )
            return back()
                ->withErrors("Captcha hiba. Próbáld újra!")
                ->withInput();

        //1. létezik az e-mail cím?
        $email = $request->email;
        $user = User::where("email", $email)->first();
        if ( $user ) {
            //van e-mail cím
            $confirmCode = "";
            $elements = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","1","2","3","4","5","6","7","8","9","0"];
            for ($i=0; $i < 12; $i++) { 
                $confirmCode = $confirmCode . $elements[rand(0,count($elements)-1)];
            }

            $user->lost_pwd_token = $confirmCode;
            $user->save();

            // e-mail küldése
            Mail::to($email)->send(new LostPasswordMail($user));


            // köszönő oldal
            return redirect()->back()->withSuccess("A jelszó helyreállító link elküldve!");
        } else {
            //nincs e-mail cím
            return back()
                ->withErrors("Nincs ilyen e-mail cím!")
                ->withInput();
        }
    }

    public function ChangeLostPassword($email, $confirmCode)
    {
        // 1. létezik-e az adatbázisban
        $user = User::where("email",$email)
                    ->where("lost_pwd_token",$confirmCode)
                    ->first();

        if ( $user ) {
            // megvan a user
            return view("Auth.ChangeLostPassword")
                ->with("email", $email)
                ->with("confirmCode", $confirmCode);
        } else {
            // hibás kód
            abort(403);
        }
    }

    public function SendChangeLostPassword(Request $request)
    {
        // 1. létezik-e az adatbázisban
        $user = User::where("email",$request->email)
                    ->where("lost_pwd_token",$request->confirmCode)
                    ->first();

        if ( $user ) {
            // megvan a user

            // jelszó ellenőrzése
            $rules = [
                "password" => "required|confirmed"
            ];
            $messages = [
                "password.required" => "A jelszó mező kitöltése kötelező!",
                "password.confirmed" => "A beírt jelszavak nem egyeznek!"
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ( $validator->fails() )
                return back()
                    ->withErrors($validator)
                    ->withInput();

            // jó, mehet DB-be
            $user->password = Hash::make($request->password);
            $user->lost_pwd_token = null;
            $user->save();

            return redirect()->route("login");
        } else {
            // hibás kód
            abort(403);
        }
    }

    public function SendRegist(Request $request){
        //0. reCaptcha ellenőrzés
        if ( !Helper::checkRecapctha($request->reCaptchaToken) )
            return back()
                ->withErrors("Captcha hiba. Próbáld újra!")
                ->withInput();
        
        //1. validálás
        $rules = [
            "firstname" => "required",
            "lastname" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed",
            
        ];

        $messages = [
            "firstname.required" => "A vezetéknév mező kitöltése kötelező!",
            "lastname.required" => "A keresztnév mező kitöltése kötelező!",
            "email.required" => "Az e-mail cím mező kitöltése kötelező!",
            "email.unique" => "A megadott e-mail cím már létezik, válasszon másikat vagy jelentkezzen be fiókjába.",
            "email.email" => "Az e-mail cím formátuma hibás!",
            "password.required" => "A jelszó mező kitöltése kötelező!",
            "password.confirmed" => "A beírt jelszavak nem egyeznek!"
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ( $validator->fails() )
            return back()
                ->withErrors($validator)
                ->withInput();

        /*kép feltöltés
        $userAvatar="";

        if ( $request->avatar ) {
            $image = $request->file('avatar');
            $imageInfo = pathinfo($image->getClientOriginalName());
            $imageName = \Carbon\Carbon::now()->format("U").Str::slug($request->name).".".$imageInfo['extension'];
            $destinationPath = public_path('/images/users');
            $image->move($destinationPath, $imageName);
            $userAvatar = "/images/users/".$imageName;
        }
        */

        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = 4;

        $user->save();

        return redirect()->route("successreg");
    }
    public function SuccessReg()
    {
        return view("Auth.SuccessReg");  
    }
}
