<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::get('users', 'UserController@index');
Route::get('users/{user}', 'UserController@show');

Route::get('programs', 'ProgramController@index');
Route::get('programs/{program}', 'ProgramController@show');

Route::middleware('guest')->group(function (): void {
    Route::view('login', 'auth.login')->name('login');
    Route::view('register', 'auth.register')->name('register');
});

Route::view('password/reset', 'auth.passwords.email')->name('password.request');
Route::get('password/reset/{token}', 'Auth\PasswordResetController')->name('password.reset');

Route::middleware('auth')->group(function (): void {
    Route::view('email/verify', 'auth.verify')->middleware('throttle:6,1')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'Auth\EmailVerificationController')->middleware('signed')->name('verification.verify');

    Route::post('logout', 'Auth\LogoutController')->name('logout');

    Route::view('password/confirm', 'auth.passwords.confirm')->name('password.confirm');
});
