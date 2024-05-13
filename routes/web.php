<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [PostController::class,'index'])->name('post.index');
Route::get('/posts/{post}',[PostController::class,'show'])->name('posts.show');

Route::get('/dashboard', [AdminController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/comment',[CommentController::class,'store'])->name('post.comment');
Route::middleware('auth')->group(function () {

    Route::get('post/create',[AdminController::class,'create'])->name('post.create');
    Route::post('/post/store',[AdminController::class,'store'])->name('post.store');
    Route::get('/post/edit/{id}',[AdminController::class,'edit'])->name('post.edit');
    Route::put('/post/update', [AdminController::class, 'update'])->name('post.update');
    Route::delete('/post/delete/{id}', [AdminController::class, 'destroy'])->name('post.delete');

    


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Route::get('')

require __DIR__.'/auth.php';
