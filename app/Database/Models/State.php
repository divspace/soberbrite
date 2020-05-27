<?php

namespace App\Database\Models;

use App\Database\Models\Location;
use App\Database\Traits\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
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

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }
}
