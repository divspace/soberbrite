<?php

declare(strict_types = 1);

use App\Providers\RouteServiceProvider;
use Laravel\Fortify\Features;

return [

    'guard' => 'web',

    'passwords' => 'users',

    'username' => 'email',

    'home' => RouteServiceProvider::HOME,

    'limiters' => [
        'login' => null,
    ],

    'features' => [
        Features::registration(),
        Features::resetPasswords(),
        Features::emailVerification(),
        Features::updateProfileInformation(),
        Features::updatePasswords(),
        Features::twoFactorAuthentication(),
    ],

];
