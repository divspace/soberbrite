<?php

declare(strict_types = 1);

namespace App\Actions\Fortify;

use App\Database\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

final class ResetUserPassword implements ResetsUserPasswords
{
    use PasswordValidationRules;

    public function reset($user, array $input): void
    {
        Validator::make($input, [
            User::PASSWORD => $this->passwordRules(),
        ])->validateWithBag('updatePassword');

        $user->forceFill([
            User::PASSWORD => Hash::make($input[User::PASSWORD]),
        ])->save();
    }
}
