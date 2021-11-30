<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\UserRole;
use App\Models\DailyTask;

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
        $tasks = DailyTask::where("user_id", Auth::user()->id)
                    ->get();
        
        return view("Admin.Personal.Daily")
            ->with("tasks", $tasks);
    }
    public function AddDailyTask(Request $request){
        $newtask = new DailyTask;
        $newtask->user_id =  Auth::user()->id;
        $newtask->task = $request->newTask;
        $newtask->save();

        return redirect()->back();
    }
}
