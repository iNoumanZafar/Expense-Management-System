<?php

use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\User\ExpenseController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
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
        Route::get('/dashboard', [UserDashboardController::class, 'index'])
            ->name('dashboard');

        // Save the user's own monthly budget (form on the dashboard)
        Route::put('/budget', [UserDashboardController::class, 'updateBudget'])
            ->name('budget.update');

        // User Expenses
        Route::get('/expenses', [ExpenseController::class, 'index'])
            ->name('expenses.index');
        Route::get('/expenses/create', [ExpenseController::class, 'create'])
            ->name('expenses.create');
        Route::post('/expenses', [ExpenseController::class, 'store'])
            ->name('expenses.store');
        Route::get('/expenses/{expense}/edit', [ExpenseController::class, 'edit'])
            ->name('expenses.edit');
        Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])
            ->name('expenses.update');
        Route::delete('/expenses/{id}', [ExpenseController::class, 'destroy'])
            ->name('expenses.destroy');
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

        // Admin Rooms (UI only for now, sample data in the view)
        Route::get('/rooms', function () {
            return view('admin.rooms');
        })->name('rooms.index');

        // Admin Users: assign users to rooms (UI only for now, sample data in the view)
        Route::get('/users', function () {
            return view('admin.users');
        })->name('users.index');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
