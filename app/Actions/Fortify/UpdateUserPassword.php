<?php

declare(strict_types = 1);

namespace App\Actions\Fortify;

use App\Database\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

final class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * @var string
     */
    private const CURRENT_PASSWORD = 'current_password';

    /**
     * @throws ValidationException
     */
    public function update($user, array $input): void
    {
        Validator::make($input, [
            self::CURRENT_PASSWORD => ['required', 'string'],
            User::PASSWORD => $this->passwordRules(),
        ])->after(static function ($validator) use ($user, $input): void {
            if (!Hash::check($input[self::CURRENT_PASSWORD], $user->password)) {
                $validator->errors()->add(self::CURRENT_PASSWORD, __('The provided password does not match your current password.'));
            }
        })->validateWithBag('updatePassword');

        $user->forceFill([
            User::PASSWORD => Hash::make($input[User::PASSWORD]),
        ])->save();
    }
}
