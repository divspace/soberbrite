<?php

declare(strict_types = 1);

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', static fn () => view('dashboard'))
    ->name('dashboard');

Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
