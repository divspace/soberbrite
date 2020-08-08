<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Api;

use App\Database\Models\Location;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationCollection;
use App\Http\Resources\LocationResource;

final class LocationController extends Controller
{
    public function index(): LocationCollection
    {
        return new LocationCollection(Location::paginate());
    }

    public function show(Location $location): LocationResource
    {
        return new LocationResource($location);
    }
}
