<?php

use App\Http\Controllers\ProfileController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    $featured_posts = Post::all();
    return view('home' , compact('featured_posts'));
})->name('home');

Route::get('/show/post/{id}' , [App\Http\Controllers\PostController::class , 'showPost'])->name('show_post');
Route::post('/add/comment/' , [App\Http\Controllers\CommentController::class , 'addComment'])->name('add_comment');
require __DIR__.'/auth.php';
