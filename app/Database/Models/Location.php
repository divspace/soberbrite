<?php

namespace App\Database\Models;

use App\Database\Casts\Timezone;
use App\Database\Models\City;
use App\Database\Models\State;
use App\Database\Models\ZipCode;
use App\Database\Traits\HasSpatial;
use App\Database\Traits\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    use HasSpatial, HasTimestamps;

    protected $fillable = [
        'coordinate',
        'timezone_offset',
        'observes_dst',
    ];

    protected $spatialFields = [
        'coordinate',
    ];

    protected $casts = [
        'id' => 'integer',
        'city_id' => 'integer',
        'state_id' => 'integer',
        'zip_code_id' => 'integer',
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
        return $this->BelongsTo(City::class);
    }

    public function state(): BelongsTo
    {
        return $this->BelongsTo(State::class);
    }

    public function zipCode(): BelongsTo
    {
        return $this->BelongsTo(ZipCode::class);
    }

    public function longitude(): float
    {
        return $this->coordinate->getLng();
    }

    public function latitude(): float
    {
        return $this->coordinate->getLat();
    }
}
