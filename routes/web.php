<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::get('users', 'UserController@index');
Route::get('users/{user}', 'UserController@show');
