<?php

declare(strict_types = 1);

use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\StateController;
use Illuminate\Support\Facades\Route;

Route::get('/cities', [CityController::class, 'index'])->name('cities.index');
Route::get('/cities/{city}', [CityController::class, 'show'])->name('cities.show');

Route::get('/countries', [CountryController::class, 'index'])->name('countries.index');
Route::get('/countries/{country}', [CountryController::class, 'show'])->name('countries.show');

Route::get('/states', [StateController::class, 'index'])->name('states.index');
Route::get('/states/{state}', [StateController::class, 'show'])->name('states.show');
