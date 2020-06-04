<?php

namespace App\Http\Livewire\Auth;

use App\Database\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    public function register(): void
    {
        $this->validate([
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'same:password_confirmation'],
        ]);

        $user = User::create([
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));

        Auth::login($user, true);

        redirect(route('home'));
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
