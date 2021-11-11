<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;

//use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function Login(){
        return view("Auth.Login");
    }
    public function LoginAttempt(){
    }
    public function LogOut(){
       
    }
    public function Regist(){
        return view("Auth.Regist");
    }
    
    public function LostPassword(){
        //return view("Auth.LostPassword");
    }

    public function SendRegist(){
        
    }
    public function SuccessReg()
    {
        
        //return view("Auth.SuccessReg");
    }
}
