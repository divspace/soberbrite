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
        return User::all();
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
        // $soberDate = Carbon::parse($user->sobriety_date);
        // $soberDays = $soberDate->diffInDays().' '.Str::plural('day', $soberDate->diffInDays());

        return view('users.show', compact('user'));
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
