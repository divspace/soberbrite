<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Api;

use App\Database\Models\ZipCode;
use App\Http\Controllers\Controller;
use App\Http\Resources\ZipCodeCollection;
use App\Http\Resources\ZipCodeResource;

final class ZipCodeController extends Controller
{
    public function index(): ZipCodeCollection
    {
        return new ZipCodeCollection(ZipCode::paginate());
    }

    public function show(ZipCode $zipCode): ZipCodeResource
    {
        return new ZipCodeResource($zipCode);
    }
}
