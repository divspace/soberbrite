<?php

use PhpUnitGen\Core\Generators\Tests\DelegateTestGenerator;

return [

    'overwriteFiles' => false,

    'backupFiles' => true,

    'excludedFiles' => [],

    'includedFiles' => [
        '\.php$',
    ],

    'generateOnMake' => true,

    'automaticGeneration' => true,

    'implementations' => DelegateTestGenerator::implementations(),

    'baseNamespace' => 'App',

    'baseTestNamespace' => 'Tests',

    'testCase' => 'Tests\\TestCase',

    'excludedMethods' => [
        '__construct',
        '__destruct',
    ],

    'mergedPhpDoc' => [
        'author',
        'copyright',
        'license',
        'version',
    ],

    'phpDoc' => [],

    'options' => [
        'context' => 'laravel',
        'laravel.user' => 'App\\Database\\Models\\User',
    ],

];
