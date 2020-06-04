<?php

namespace App\Database\Models;

use App\Database\Traits\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class City extends Model
{
    use HasTimestamps;

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
    ];

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }
}
