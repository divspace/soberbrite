<?php

namespace App\Database\Models;

use App\Database\Casts\Timezone;
use App\Database\Traits\HasSpatial;
use App\Database\Traits\HasTimestamps;
use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model
{
    use HasSpatial, HasTimestamps;

    protected $fillable = [
        'zip',
        'city',
        'state',
        'coordinate',
        'timezone_offset',
        'has_dst',
    ];

    protected $spatialFields = [
        'coordinate',
    ];

    protected $casts = [
        'timezone_offset' => Timezone::class,
        'has_dst' => 'boolean',
    ];
}
