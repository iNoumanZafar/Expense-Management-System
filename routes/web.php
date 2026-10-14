<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard link: send the user to the right dashboard
Route::get('/dashboard', function () {
    if (auth()->user()->user_type == 'admin') {
        return redirect('/admin/dashboard');
    }

    return redirect('/user/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin dashboard (only admin can open it)
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified', 'role:admin'])->name('admin.dashboard');

// User dashboard (only user can open it)
Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified', 'role:user'])->name('user.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
