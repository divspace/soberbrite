<?php

namespace App\Http\Livewire\Auth;

use App\Database\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $email = '';

    public $password = '';

    public $password_confirmation = '';

    public function register()
    {
        $this->validate([
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'same:password_confirmation'],
        ]);

        $user = User::create([
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->sendEmailVerificationNotification();

        Auth::login($user, true);

        redirect(route('home'));
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
