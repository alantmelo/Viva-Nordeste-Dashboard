<?php

return [

    'default' => env('HASH_DRIVER', 'bcrypt'),

    'bcrypt' => [
        'rounds' => env('BCRYPT_ROUNDS', 10),
    ],

    'argon' => [
        'memory' => 65536,
        'threads' => 1,
        'time' => 4,
    ],
];
