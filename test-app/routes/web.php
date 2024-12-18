<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ToppageController;

Route::get('/', function () {
    return view('Welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('post/create', [PostController::class, 'create']);

Route::post('post', [PostController::class, 'store'])
->name('post.store');

Route::get('post',[PostController::class, 'index']);

Route::get('post/show/{post}', [PostController::class, 'show'])
->name('post.show');
require __DIR__.'/auth.php';

// Route::get('/', [PostController::class, 'index'])->name('home');
// Route::post('post', [PostController::class, 'store'])->name('post.store');
// Route::get('/search', [PostController::class, 'search'])->name('search');

Route::get('/toppage',[ToppageController::class, 'index'])->name('toppage');
Route::post('/posts',[Toppagecontroller::class, 'store'])->name('post.store');

