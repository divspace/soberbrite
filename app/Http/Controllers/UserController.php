<?php

namespace App\Http\Controllers;

use App\Database\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return User::with(['address', 'profile'])->get();
    }

    public function show(User $user): \Illuminate\View\View
    {
        return view('users.show')->with([
            'user' => $user,
        ]);
    }
}
