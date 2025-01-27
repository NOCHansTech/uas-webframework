<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\UsermanController;
use App\Http\Controllers\AdminController;

// Route::get('/', function () {
//     return view('page.index');
// });
Route::get('logout', [AuthController::class, 'logout'])->middleware(['auth']);

Route::middleware(['guest'])->group(function () {
    Route::get('auth/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('auth/login', [AuthController::class, 'authenticate']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', [LinkController::class, 'index'])->name('dashboard');
    // Route::get('shortened-link', [LinkController::class, 'linkList']);
    Route::post('shorten', [LinkController::class, 'store']);
    Route::get('link/{id}', [LinkController::class, 'show'])->name('link.show');
    Route::put('shorten/{id}', [LinkController::class, 'update'])->name('link.update');
    Route::delete('shorten/{id}/delete', [LinkController::class, 'destroy'])->name('delete.link');
});

Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('shortened-link', [AdminController::class, 'linkList']);
    Route::resource('userman', UsermanController::class)->only('index', 'store', 'destroy', 'show', 'update');
});
Route::get('/s/{shortenedUrl}', [LinkController::class, 'redirectToOriginal']);
