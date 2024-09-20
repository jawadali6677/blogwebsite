<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function home()
    {
        $featured_posts = Post::where(['is_featured' => true, 'published' => true])->get();
        $latest_posts = Post::where(['published' => true])->orderBy('id' , 'DESC')->with(['comments'])->take(7)->get();
        return view('home' , compact('featured_posts' , 'latest_posts'));
    }
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
