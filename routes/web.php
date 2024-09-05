<?php


use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $featured_posts = Post::all();
    return view('home' , compact('featured_posts'));
});

Route::get('/show/post/{id}' , [App\Http\Controllers\PostController::class , 'showPost'])->name('show_post');
