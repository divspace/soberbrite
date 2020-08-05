<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Api;

use App\Database\Models\Country;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryCollection;
use App\Http\Resources\CountryResource;

final class CountryController extends Controller
{
    public function index(): CountryCollection
    {
        return new CountryCollection(Country::all());
    }

    public function show(Country $country): CountryResource
    {
        return new CountryResource($country);
    }
}
