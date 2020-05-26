<?php

namespace App\Database\Models;

use App\Database\Traits\HasTimestamps;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasTimestamps;

    protected $fillable = [
        'code',
        'name',
    ];
}
