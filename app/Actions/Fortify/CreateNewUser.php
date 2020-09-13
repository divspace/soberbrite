<?php

declare(strict_types = 1);

namespace App\Actions\Fortify;

use App\Database\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

final class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * @throws ValidationException
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            User::EMAIL => ['required', 'string', User::EMAIL, 'max:255', 'unique:users'],
            User::PASSWORD => $this->passwordRules(),
        ])->validate();

        return User::create([
            User::EMAIL => $input[User::EMAIL],
            User::PASSWORD => Hash::make($input[User::PASSWORD]),
        ]);
    }
}
