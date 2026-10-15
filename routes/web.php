<?php

use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard link: send the user to the right dashboard
// All authenticated and verified users
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard link: send the user to the right dashboard
    Route::get('/dashboard', function () {
        if (auth()->user()->user_type == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    })->name('dashboard');

    // User-only routes
    Route::middleware('role:user')->prefix('user')->name('user.')->group(function () {
        // User Dashboard
        Route::get('/dashboard', function () {
            return view('user.dashboard');
        })->name('dashboard');
    });

    // Admin-only routes

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        // Admin Dashboard
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Admin Settings
        Route::get('/settings', [SettingController::class, 'index'])
            ->name('settings');

        Route::post('/settings', [SettingController::class, 'store'])
            ->name('settings.store');

        // Admin Categories
        Route::get('/categories', [CategoryController::class, 'index'])
            ->name('categories.index');
        Route::post('/categories', [CategoryController::class, 'store'])
            ->name('categories.store');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
