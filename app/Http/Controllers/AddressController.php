<?php

namespace App\Http\Controllers;

use App\Database\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        return Address::all();
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(Address $address)
    {
    }

    public function edit(Address $address)
    {
    }

    public function update(Request $request, Address $address)
    {
    }

    public function destroy(Address $address)
    {
    }
}
