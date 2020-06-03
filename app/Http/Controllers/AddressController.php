<?php

namespace App\Http\Controllers;

use App\Database\Models\Address;

class AddressController extends Controller
{
    public function index()
    {
        return Address::all();
    }
}
