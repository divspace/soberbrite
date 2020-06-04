<?php

namespace App\Database\Models;

use App\Database\Traits\HasTimestamps;
use App\Database\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

final class Program extends Model
{
    use HasTimestamps, HasUuid;

    protected $fillable = [
        'name',
        'abbreviation',
    ];

    protected $casts = [
        'id' => 'string',
        'program_type_id' => 'integer',
        'name' => 'string',
        'abbreviation' => 'string',
    ];
}
