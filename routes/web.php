<?php

use App\Http\Controllers\ProfileController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile_update');
});

Route::get('/' , [App\Http\Controllers\PostController::class , 'home'])->name('home');
Route::get('/show/post/{id}' , [App\Http\Controllers\PostController::class , 'showPost'])->name('show_post');
// Route::post('/add/comment/' , [App\Http\Controllers\CommentController::class , 'addComment'])->name('add_comment')->middleware('auth');
Route::get('/category/posts/{id}' , [App\Http\Controllers\PostController::class , 'categoryPosts'])->name('category_posts');
Route::get('/featured/posts' , [App\Http\Controllers\PostController::class , 'featuredPosts'])->name('featured_posts');

// LIKE
Route::post('/like/comment' , [App\Http\Controllers\CommentLikeController::class , 'likeComment'])->name('like_comment');
Route::post('/like/post' , [App\Http\Controllers\PostLikeController::class , 'likePost'])->name('like_post');
require __DIR__.'/auth.php';
