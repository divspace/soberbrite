<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Database\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

final class UserController extends Controller
{
    public function index(): Collection
    {
        return User::with(['address', 'profile'])->get();
    }

    public function show(User $user): View
    {
        return view('users.show')->with([
            'user' => $user,
        ]);
    }
}
