<?php

namespace App\Http\Controllers;

use App\Database\Models\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        return Profile::all();
    }
}
