<?php

namespace App\Http\Controllers;

use App\Database\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        return User::with('profile')->get();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user): \Illuminate\View\View
    {
        $soberDate = Carbon::parse($user->profile->sobriety_date);
        $soberDays = $soberDate->diffInDays().' '.Str::plural('day', $soberDate->diffInDays());

        return view('users.show')->with([
            'user' => $user,
            'soberDate' => $soberDate,
            'soberDays' => $soberDays,
        ]);
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}
