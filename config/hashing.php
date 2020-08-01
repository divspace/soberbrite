<?php

declare(strict_types = 1);

return [

    'driver' => 'argon2id',

    'bcrypt' => [
        'rounds' => env('BCRYPT_ROUNDS', 10),
    ],

    'argon' => [
        'memory' => 1_024,
        'threads' => 2,
        'time' => 2,
    ],

];
