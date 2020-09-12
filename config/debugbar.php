<?php

declare(strict_types = 1);

return [

    'enabled' => env('DEBUGBAR_ENABLED', null),

    'except' => [
        'telescope*',
        'horizon*',
    ],

    'storage' => [
        'enabled' => true,
        'driver' => 'redis',
        'path' => storage_path('debugbar'),
        'connection' => null,
        'provider' => '',
    ],

    'include_vendors' => true,

    'capture_ajax' => true,

    'add_ajax_timing' => false,

    'error_handler' => false,

    'clockwork' => false,

    'collectors' => [
        'phpinfo' => true,
        'messages' => true,
        'time' => true,
        'memory' => true,
        'exceptions' => true,
        'log' => true,
        'db' => true,
        'views' => true,
        'route' => true,
        'auth' => false,
        'gate' => true,
        'session' => true,
        'symfony_request' => true,
        'mail' => true,
        'laravel' => false,
        'events' => false,
        'default_request' => false,
        'logs' => false,
        'files' => false,
        'config' => false,
        'cache' => false,
        'models' => true,
        'livewire' => true,
    ],

    'options' => [
        'auth' => [
            'show_name' => true,
        ],
        'db' => [
            'with_params' => true,
            'backtrace' => true,
            'backtrace_exclude_paths' => [],
            'timeline' => false,
            'explain' => [
                'enabled' => true,
                'types' => ['SELECT', 'INSERT', 'UPDATE', 'DELETE'],
            ],
            'hints' => true,
        ],
        'mail' => [
            'full_log' => false,
        ],
        'views' => [
            'data' => false,
        ],
        'route' => [
            'label' => true,
        ],
        'logs' => [
            'file' => null,
        ],
        'cache' => [
            'values' => true,
        ],
    ],

    'inject' => true,

    'route_prefix' => '_debugbar',

    'route_domain' => null,

    'theme' => 'auto',

];
