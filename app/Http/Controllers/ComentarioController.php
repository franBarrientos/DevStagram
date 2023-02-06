<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class ComentarioController extends Controller
{
    public function store(User $user,Post $post,Request $request)
    {
        $this->validate($request,[
            "comentario" => "min:1|max:255",
        ]);

        
        Comentario::create([
            "comentario" => $request->comentario,
            "user_id" => auth()->user()->id,
            "post_id" => $post->id
        ]); 

        return back()->with("mensaje","Comentario Realizado Correctamente");

    }
}
