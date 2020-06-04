<?php

namespace App\Http\Controllers;

use App\Database\Models\Profile;
use Illuminate\Database\Eloquent\Collection;

final class ProfileController extends Controller
{
    public function index(): Collection
    {
        return Profile::all();
    }
}
