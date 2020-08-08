<?php

declare(strict_types = 1);

use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\StateController;
use App\Http\Controllers\Api\ZipCodeController;
use Illuminate\Support\Facades\Route;

Route::get('/cities', [CityController::class, 'index'])->name('cities.index');
Route::get('/cities/{city}', [CityController::class, 'show'])->name('cities.show');

Route::get('/countries', [CountryController::class, 'index'])->name('countries.index');
Route::get('/countries/{country}', [CountryController::class, 'show'])->name('countries.show');

Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
Route::get('/locations/{location}', [LocationController::class, 'show'])->name('locations.show');

Route::get('/states', [StateController::class, 'index'])->name('states.index');
Route::get('/states/{state}', [StateController::class, 'show'])->name('states.show');

Route::get('/zip-codes', [ZipCodeController::class, 'index'])->name('zipCodes.index');
Route::get('/zip-codes/{zipCode}', [ZipCodeController::class, 'show'])->name('zipCodes.show');
