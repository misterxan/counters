<?php
return [
    'redis' => [
        'client' => 'predis',
        'cluster' => false,
        'default' => [
            'host'     => env('REDIS_HOST'),
            'password' => env('REDIS_PASSWORD', null),
            'port'     => env('REDIS_PORT', 6379),
            'database' => 0,
        ],
    ]
];
