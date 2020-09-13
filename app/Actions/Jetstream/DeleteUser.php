<?php

declare(strict_types = 1);

namespace App\Actions\Jetstream;

use Laravel\Jetstream\Contracts\DeletesUsers;

final class DeleteUser implements DeletesUsers
{
    public function delete($user): void
    {
        $user->delete();
    }
}
