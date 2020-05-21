<?php

namespace App\Database\Models;

use App\Database\Traits\HasTimestamps;
use App\Database\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasTimestamps, HasUuid;

    protected $fillable = [
        'program_type_id',
        'name',
        'abbreviation',
    ];

    protected $casts = [
        'uuid' => EfficientUuid::class,
        'program_type_id' => 'integer',
    ];
}
