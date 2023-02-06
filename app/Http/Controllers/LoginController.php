<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view("auth.login");
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            "email" => "required",
            "password" => "required"
        ]);


        auth()->attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);
        // GO TO
        if(auth()->attempt(["email" => $request->email,
        "password" => $request->password],$request->remember)){
            return redirect()->route("post.index",auth()->user()->username);
        }else{
            return back()->with("mensaje","Credenciales Incorrectas");
        };




    }
}
