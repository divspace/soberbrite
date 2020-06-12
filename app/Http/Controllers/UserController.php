<?php

namespace App\Http\Controllers;

use App\Database\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

final class UserController extends Controller
{
    /**
     * @return Builder[]|Collection
     */
    public function index()
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
