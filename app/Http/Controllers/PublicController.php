<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Address;
use App\Models\Address_type;
use App\Models\User;
use App\Models\Country;

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
    
    public function Contact(){
        return view("Public.Contact");
    }
    public function Timetable(){
        return view("Public.ClassTimetable");
    }

    public function Services(){
        return view("Public.Services");
    }

   

}
