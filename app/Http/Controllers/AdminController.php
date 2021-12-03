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
        $activeTasks = DailyTask::where("user_id", Auth::user()->id)
                    ->where("status", 1)
                    ->get();

        $inActiveTasks = DailyTask::where("user_id", Auth::user()->id)
        ->where("status", 0)
        ->get();

        
        return view("Admin.Personal.Daily")
            ->with("activeTasks", $activeTasks)
            ->with("inActiveTasks", $inActiveTasks);
    }
    public function AddDailyTask(Request $request){
        $newtask = new DailyTask;
        $newtask->user_id =  Auth::user()->id;
        $newtask->task = $request->newTask;
        $newtask->save();

        return redirect()->route("daily");
    }

    public function SetDalyTaskInactice($id)
    {
        $task = DailyTask::findOrFail($id);
        $task->status="0";
        $task->save();

        return "OK";
    }

    public function DeleteTasks()
    {
        $inActiveTasks = DailyTask::where("user_id", Auth::user()->id)
            ->where("status", 0)
            ->get();

        foreach ($inActiveTasks as $inActiveTask) {
            $inActiveTask->delete();
        }

        return redirect()->route("daily");
    }
}
