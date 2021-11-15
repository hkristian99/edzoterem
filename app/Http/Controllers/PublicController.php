<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view("Public.Profile");
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
