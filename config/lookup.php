<?php

declare(strict_types = 1);

return [

    'tables' => [

        'area_codes' => [
            'fill_order' => 6,
            'file_path' => storage_path('csv/area-codes.csv'),
        ],

        'cities' => [
            'fill_order' => 1,
            'file_path' => storage_path('csv/zip-codes.csv'),
        ],

        'countries' => [
            'fill_order' => 4,
            'file_path' => storage_path('csv/countries.csv'),
        ],

        'locations' => [
            'fill_order' => 5,
            'file_path' => storage_path('csv/zip-codes.csv'),
        ],

        'states' => [
            'fill_order' => 2,
            'file_path' => storage_path('csv/states.csv'),
        ],

        'zip_codes' => [
            'fill_order' => 3,
            'file_path' => storage_path('csv/zip-codes.csv'),
        ],

    ],

];
