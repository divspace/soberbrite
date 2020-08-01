<?php

declare(strict_types = 1);

return [

    'filename' => '_ide_helper',

    'format' => 'php',

    'meta_filename' => '.phpstorm.meta.php',

    'include_fluent' => true,

    'include_factory_builders' => true,

    'write_model_magic_where' => true,

    'write_eloquent_model_mixins' => true,

    'include_helpers' => true,

    'helper_files' => [
        base_path().'/vendor/laravel/framework/src/Illuminate/Support/helpers.php',
    ],

    'model_locations' => [
        'app/Database/Models',
    ],

    'ignored_models' => [],

    'extra' => [
        'Eloquent' => [
            'Illuminate\Database\Eloquent\Builder',
            'Illuminate\Database\Query\Builder',
        ],
        'Session' => [
            'Illuminate\Session\Store',
        ],
    ],

    'magic' => [],

    'interfaces' => [],

    'custom_db_types' => [],

    'model_camel_case_properties' => true,

    'type_overrides' => [
        'integer' => 'int',
        'boolean' => 'bool',
    ],

    'include_class_docblocks' => false,

];
