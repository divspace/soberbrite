<?php

declare(strict_types = 1);

namespace App\Actions\Fortify;

use App\Database\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

final class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * @throws ValidationException
     */
    public function update($user, array $input): void
    {
        Validator::make($input, [
            User::EMAIL => ['required', User::EMAIL, 'max:255', Rule::unique('users')->ignore($user->id)],
        ])->validateWithBag('updateProfileInformation');

        $user->forceFill([
            User::EMAIL => $input[User::EMAIL],
        ])->save();
    }
}
