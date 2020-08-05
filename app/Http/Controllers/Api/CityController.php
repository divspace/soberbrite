<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Api;

use App\Database\Models\City;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityCollection;
use App\Http\Resources\CityResource;

final class CityController extends Controller
{
    public function index(): CityCollection
    {
        return new CityCollection(City::paginate());
    }

    public function show(City $city): CityResource
    {
        return new CityResource($city);
    }
}
