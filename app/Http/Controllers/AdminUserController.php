<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $users = User::all();
        //$users = User::sortable('id')->paginate(20);
        
        return view("Admin.Users.Index")
                ->with("users", $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $password = "";
        $elements = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","1","2","3","4","5","6","7","8","9","0"];
        for ($i=0; $i < 12; $i++) { 
            $password = $password . $elements[rand(0,count($elements)-1)];
        }
        $roles = Role::all();

        return view("Admin.Users.Create")
                ->with("roles", $roles)
                ->with("password", $password);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $roles=$request->roles;
        
        dd($request);
        foreach($roles as $roleID){ 
            $val = $roles[1];
        }
        dd($val);
        //1. validálás
        $rules = [
            "firstname" => "required",
            "lastname" => "required",
            "email" => "required|email|unique:users",
            "roles" => "required"
        ];

        $messages = [
            "firstname.required" => "A vezetéknév megadása kötelező!",
            "lastname.required" => "A keresztnév megadása kötelező!",
            "email.required" => "Az e-mail cím megadása kötelező!",
            "email.unique" => "A megadott e-mail cím már létezik, válasszon másikat!",
            "email.email" => "Az e-mail cím formátuma hibás!",
            "roles.required" => "A szerepkör megadása kötelező!"
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ( $validator->fails() )
            return back()
                ->withErrors($validator)
                ->withInput();

        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->password = $request->password;
        $user->email = $request->email;
        $user->save();

        foreach($request->roles as $roleID){
            $role = new UserRole();
            $role->user_id= $user->id;
            $role->role_id=$roleID;
            $role->save();
        }
        return redirect()->route("adminUsers")->withSuccess("A felhasználó létrehozása sikerült!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::orderBy("name")->get();

        return view("Admin.Users.Edit")
            ->with("user", $user)
            ->with("roles", $roles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
