<?php

namespace App\Database\Models;

use App\Database\Casts\Timezone;
use App\Database\Traits\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Location extends Model
{
    use HasTimestamps;

    protected $fillable = [
        'latitude',
        'longitude',
        'timezone_offset',
        'observes_dst',
    ];

    protected $casts = [
        'id' => 'integer',
        'city_id' => 'integer',
        'state_id' => 'integer',
        'zip_code_id' => 'integer',
        'latitude' => 'decimal',
        'longitude' => 'decimal',
        'timezone_offset' => Timezone::class,
        'observes_dst' => 'boolean',
    ];

    protected $with = [
        'city',
        'state',
        'zipCode',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function zipCode(): BelongsTo
    {
        return $this->belongsTo(ZipCode::class);
    }
}
