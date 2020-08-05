<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Api;

use App\Database\Models\State;
use App\Http\Controllers\Controller;
use App\Http\Resources\StateCollection;
use App\Http\Resources\StateResource;

final class StateController extends Controller
{
    public function index(): StateCollection
    {
        return new StateCollection(State::all());
    }

    public function show(State $state): StateResource
    {
        return new StateResource($state);
    }
}
