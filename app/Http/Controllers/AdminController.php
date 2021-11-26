<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\UserRole;

class AdminController extends Controller
{
    public function Dashboard(){
        
        $roles= UserRole::all();

        return view("Admin.Dashboard")
                ->with("roles",$roles);
    }
    public function Calendar(){
        return view("Admin.Personal.Calendar");
    }
    public function Daily(){
        return view("Admin.Personal.Daily");
    }
}
