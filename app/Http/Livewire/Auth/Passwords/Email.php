<?php

namespace App\Http\Livewire\Auth\Passwords;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class Email extends Component
{
    public $email;

    public bool $emailSentMessage = false;

    public function sendResetPasswordLink(): void
    {
        $this->validate([
            'email' => ['required', 'email'],
        ]);

        $response = $this->broker()->sendResetLink(['email' => $this->email]);

        if ($response === Password::RESET_LINK_SENT) {
            $this->emailSentMessage = trans($response);

            return;
        }

        $this->addError('email', trans($response));
    }

    public function broker()
    {
        return Password::broker();
    }

    public function render()
    {
        return view('livewire.auth.passwords.email');
    }
}
