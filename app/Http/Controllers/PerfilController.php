<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index(User $user)
    {
        if(auth()->user()->id !== $user->id){
            return redirect()->route("perfil.index",['user' => auth()->user()]);
        };
        return view("perfil.index");


        //NO ME DEJA USAR POLICY!!

    }

    public function store(User $user,Request $request)
    {

        $request->request->add(["username" => Str::slug($request->username)]);

        $this->validate($request,[
            "username" => "required|unique:users,username,".auth()->user()->id."|min:3|max:20|",
            "email" => "required|unique:users,username,".auth()->user()->email 
        ]);

        if($request->imagen){
            $imagen = $request->file("imagen");
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
    
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000,1000);
    
            $imagenPath = public_path("perfiles")."/".$nombreImagen;
            $imagenServidor->save($imagenPath);
        }

        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        if($request->imagen){
            $usuario->imagen = $nombreImagen ?? "";
        };
        $usuario->save();

        return redirect()->route("post.index",["user" => $usuario->username]);



    }
}
