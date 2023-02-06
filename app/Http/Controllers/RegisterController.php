<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public  function index(){
        return view("auth.register");



    }



    public  function store(Request $request){
        //ADD PERMITE CAMBIAR EL VALOR DE UN INPUT ANTES DE VALIDAR
        //VALIDATE INPUTS
        $request->request->add(["username" => Str::slug($request->username)]);
        $this->validate($request ,[
            "name" => "required|max:30",
            "username" => "required|min:4|unique:users|max:30",
            "email" => "required|unique:users",
            "password" => "required|confirmed|min:6"
        ]);
        //SAVE IN THE DB
        User::create([
            "name" => $request->name,
            "username" => $request->username,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);


        auth()->attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);
        // GO TO
        return redirect()->route("post.index",auth()->user()->username);


    }
   
}
