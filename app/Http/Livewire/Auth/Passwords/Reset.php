<?php

namespace App\Http\Livewire\Auth\Passwords;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Component;

class Reset extends Component
{
    public $token;

    public $email;

    public $password;

    public $password_confirmation;

    public function mount($token): void
    {
        $this->token = $token;
    }

    public function resetPassword()
    {
        $this->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|same:password_confirmation',
        ]);

        $response = $this->broker()->reset([
            'token' => $this->token,
            'email' => $this->email,
            'password' => $this->password,
        ], function ($user, $password): void {
            $user->password = Hash::make($password);

            $user->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));

            $this->guard()->login($user);
        });

        if ($response === Password::PASSWORD_RESET) {
            session()->flash(trans($response));

            return redirect(route('home'));
        }

        $this->addError('email', trans($response));
    }

    public function broker()
    {
        return Password::broker();
    }

    public function render()
    {
        return view('livewire.auth.passwords.reset');
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
