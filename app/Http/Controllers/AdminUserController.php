<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Role;

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
        $roles = Role::all();

        return view("Admin.Users.Create")
                ->with("roles", $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        dd($request);
        //1. validálás
        $rules = [
            "firstname" => "required",
            "lastname" => "required",
            "email" => "required|email|unique:users",
            "role_id" => "required"
        ];

        $messages = [
            "firstname.required" => "A vezetéknév megadása kötelező!",
            "laststname.required" => "A keresztnév megadása kötelező!",
            "email.required" => "Az e-mail cím megadása kötelező!",
            "email.unique" => "A megadott e-mail cím már létezik, válasszon másikat!",
            "email.email" => "Az e-mail cím formátuma hibás!",
            "role_id.required" => "A szerepkör megadása kötelező!"
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        

        if ( $validator->fails() )
            return back()
                ->withErrors($validator)
                ->withInput();
        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->role_id = 4;
        
        $user->save();

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
