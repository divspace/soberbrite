<?php

namespace App\Database\Models;

use App\Database\Traits\HasTimestamps;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasTimestamps;

    protected $fillable = [
        'code',
        'name',
    ];

    protected $casts = [
        'id' => 'integer',
        'code' => 'string',
        'name' => 'string',
    ];
}
