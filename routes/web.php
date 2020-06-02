<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::get('users', 'UserController@index');
Route::get('users/{user}', 'UserController@show');

Route::get('programs', 'ProgramController@index');
Route::get('programs/{program}', 'ProgramController@show');

Route::middleware('guest')->group(function (): void {
    Route::livewire('login', 'auth.login')
        ->layout('layouts.auth')
        ->name('login');

    Route::livewire('register', 'auth.register')
        ->layout('layouts.auth')
        ->name('register');
});

Route::livewire('password/reset', 'auth.passwords.email')
    ->layout('layouts.auth')
    ->name('password.request');

Route::livewire('password/reset/{token}', 'auth.passwords.reset')
    ->layout('layouts.auth')
    ->name('password.reset');

Route::middleware('auth')->group(function (): void {
    Route::livewire('email/verify', 'auth.verify')
        ->layout('layouts.auth')
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('email/verify/{id}/{hash}', 'Auth\EmailVerificationController')
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', 'Auth\LogoutController')
        ->name('logout');

    Route::livewire('password/confirm', 'auth.passwords.confirm')
        ->layout('layouts.auth')
        ->name('password.confirm');
});
