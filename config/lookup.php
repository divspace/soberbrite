<?php

const FILE_PATH = 'file_path';

const FILL_ORDER = 'fill_order';

return [

    'tables' => [

        'area_codes' => [
            FILL_ORDER => 6,
            FILE_PATH => storage_path('csv/area-codes.csv'),
        ],

        'cities' => [
            FILL_ORDER => 1,
            FILE_PATH => storage_path('csv/zip-codes.csv'),
        ],

        'countries' => [
            FILL_ORDER => 4,
            FILE_PATH => storage_path('csv/countries.csv'),
        ],

        'locations' => [
            FILL_ORDER => 5,
            FILE_PATH => storage_path('csv/zip-codes.csv'),
        ],

        'states' => [
            FILL_ORDER => 2,
            FILE_PATH => storage_path('csv/states.csv'),
        ],

        'zip_codes' => [
            FILL_ORDER => 3,
            FILE_PATH => storage_path('csv/zip-codes.csv'),
        ],

    ],

];
