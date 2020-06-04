<?php

namespace App\Http\Livewire\Auth\Passwords;

use Illuminate\View\View;
use Livewire\Component;

final class Confirm extends Component
{
    public string $password = '';

    public function confirm(): void
    {
        $this->validate([
            'password' => 'required|password',
        ]);

        session()->put('auth.password_confirmed_at', time());

        redirect()->intended(route('home'));
    }

    public function render(): View
    {
        return view('livewire.auth.passwords.confirm');
    }
}
