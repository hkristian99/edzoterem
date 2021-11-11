<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function Home(){
        return view("Public.Home");
    }

    public function About(){
        return view("Public.About");
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
    
    public function Contact(){
        return view("Public.Contact");
    }

    public function Gallery(){
        return view("Public.Gallery");
    }
    
    public function Profile(){
        return view("Public.Profile");
    }

    public function Team(){
        return view("Public.Team");
    }
    public function Timetable(){
        return view("Public.ClassTimetable");
    }


    public function Services(){
        return view("Public.Services");
    }

}
