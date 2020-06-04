<?php

namespace App\Database\Models;

use App\Database\Traits\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class State extends Model
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

    public function areaCodes(): HasMany
    {
        return $this->hasMany(AreaCode::class);
    }

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }
}
