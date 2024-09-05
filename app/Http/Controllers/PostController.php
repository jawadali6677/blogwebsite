<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showPost(Request $request , $id)
    {
        $post = Post::where('id' , $id)->with(['category' , 'author'])->first();
        return view('show_post' , compact('post'));
    }
}
