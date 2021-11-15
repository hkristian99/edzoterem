<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;

class AuthController extends Controller
{
    public function Login(){
        if (Auth::check())
            return redirect()->route("home");
        else
            return view("Auth.Login");;
    }

    public function LoginAttempt(Request $request){
        $email = $request->email;
        $password = $request->password;
        $credentials = $request->only(["email", "password"]);
        //dd($credentials);

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

    public function SendRegist(Request $request){
        

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
        $user->name = $request->firstname." ".$request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = 4;

        $user->save();

        return redirect()->route("successreg")->withSuccess("A regisztáció sikerült!");
    }
    public function SuccessReg()
    {
        $sec = 0;
        for ($i=6; $i>0 ; $i--) { 
           $sec = $i; 
        }

        return view("Auth.SuccessReg")
            ->with("sec", $sec);
    }
}
