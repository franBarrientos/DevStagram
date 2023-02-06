<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function __invoke()
    {
        
            $followingsId = auth()->user()->followings->pluck("id");
            $posts = Post::whereIn("user_id",$followingsId)->latest()->paginate(20);
            return view("home",[
                "posts" => $posts
            ]);
    }
}
