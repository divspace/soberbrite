<?php

namespace App\Http\Controllers;

use App\Database\Models\Address;
use Illuminate\Database\Eloquent\Collection;

class AddressController extends Controller
{
    public function index(): Collection
    {
        return Address::all();
    }
}
