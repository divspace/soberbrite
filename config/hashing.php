<?php

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
