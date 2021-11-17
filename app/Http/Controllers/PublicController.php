<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;

class PublicController extends Controller
{
    public function Home(){
        return view("Public.Home");
    }

    public function Prices(){
        return view("Public.Prices");
    }

    public function Bmi(){
        return view("Public.BmiCalculator");
    }

    public function Blog(){
        return view("Public.Blog");
    }

    public function Classes(){
        return view("Public.Classes");
    }

    public function Gallery(){
        return view("Public.Gallery");
    }
    
    public function Profile(){
        return view("Public.Profiles.Profile");
    }

    public function Contact(){
        return view("Public.Contact");
    }
    public function Timetable(){
        return view("Public.ClassTimetable");
    }

    public function Services(){
        return view("Public.Services");
    }

    public function ProfilUpdate(Request $request){
        
        //dd($request->id);
        $user = User::findOrFail(Auth::user()->id);

        //1. validálás
        $rules = [
            "firstname" => "required",
            "lastname" => "required",
            "email" => "required",
        ];

        if ( $user->email != $request->email )
            $rules["email"] = "required|email|unique:users";


        $messages = [
            "firstname.required" => "A vezetéknév mező kitöltése kötelező",
            "lastname.required" => "A keresztnév mező kitöltése kötelező",
            "email.required" => "Az e-mail cím mező kitöltése kötelező",
            "email.unique" => "A megadott e-mail cím már létezik, válasszon másikat",
            "email.email" => "Az e-mail cím formátuma hibás!",
            "password.required" => "A jelszó mező kitöltése kötelező",
            "password.confirmed" => "A két beírt jelszó nem egyezik meg!",
            
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ( $validator->fails() )
            return back()
                ->withErrors($validator)
                ->withInput();


        /*kép feltöltés
        if ( $request->avatar ) {
            $path = public_path()."/images/users/".$user->avatar;
            if ( file_exists($path) ) 
                unlink($path);

            $image = $request->file('avatar');
            $imageInfo = pathinfo($image->getClientOriginalName());
            $imageName = \Carbon\Carbon::now()->format("U").Str::slug($request->name).".".$imageInfo['extension'];
            $destinationPath = public_path('/images/users');
            $image->move($destinationPath, $imageName);

            $user->avatar = "/images/users/".$imageName;
        }
        */

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        if($request->student_card_number)
            $user->student_card_number = $request->student_card_number;

        $user->save();

        return redirect()->route("profile")->withSuccess("A módosításokat elmentettük!");
    }

}
