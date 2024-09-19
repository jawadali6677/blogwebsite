<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showPost(Request $request , $id)
    {
        $post = Post::where('id' , $id)->with(['category' , 'author' , 'comments'])->first();

        $related_posts = Post::where([['id' , '<>'  , $post->id],['category_id' , '=' , $post->category_id ]])->limit(3)->orderBy('id' , 'DESC')->get();
        return view('show_post' , compact('post' , 'related_posts'));
    }

    public function categoryPosts($category_id)
    {
        $posts = Post::where('category_id' , $category_id)->orderBy('id' , 'DESC')->get();

        return view('category_posts', compact('posts'));
    }
}
