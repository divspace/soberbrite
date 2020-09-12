<?php

declare(strict_types = 1);

use App\Database\Models\AreaCode;
use App\Database\Models\City;
use App\Database\Models\Country;
use App\Database\Models\Location;
use App\Database\Models\State;
use App\Database\Models\ZipCode;

return [

    'tables' => [

        AreaCode::TABLE => [
            'fill_order' => 6,
            'file_path' => storage_path('csv/area-codes.csv'),
        ],

        City::TABLE => [
            'fill_order' => 1,
            'file_path' => storage_path('csv/zip-codes.csv'),
        ],

        Country::TABLE => [
            'fill_order' => 4,
            'file_path' => storage_path('csv/countries.csv'),
        ],

        Location::TABLE => [
            'fill_order' => 5,
            'file_path' => storage_path('csv/zip-codes.csv'),
        ],

        State::TABLE => [
            'fill_order' => 2,
            'file_path' => storage_path('csv/states.csv'),
        ],

        ZipCode::TABLE => [
            'fill_order' => 3,
            'file_path' => storage_path('csv/zip-codes.csv'),
        ],

    ],

];
