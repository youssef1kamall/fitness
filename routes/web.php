<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MembershipPlanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Trash routes first (to avoid conflicts)
    Route::get('plans/trash', [MembershipPlanController::class, 'trash'])->name('plans.trash');
    Route::post('plans/{id}/restore', [MembershipPlanController::class, 'restore'])->name('plans.restore');

    // Status toggles
    Route::post('plans/{plan}/toggle-status', [MembershipPlanController::class, 'toggleStatus'])->name('plans.toggle-status');

    // Membership Plan CRUD
    Route::resource('plans', MembershipPlanController::class);
});

require __DIR__.'/auth.php';
