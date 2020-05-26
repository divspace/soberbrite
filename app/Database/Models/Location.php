<?php

namespace App\Database\Models;

use App\Database\Casts\Timezone;
use App\Database\Models\State;
use App\Database\Traits\HasSpatial;
use App\Database\Traits\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    use HasSpatial, HasTimestamps;

    protected $fillable = [
        'state_id',
        'zip_code',
        'city',
        'coordinate',
        'timezone_offset',
        'observes_dst',
    ];

    protected $spatialFields = [
        'coordinate',
    ];

    protected $casts = [
        'id' => 'integer',
        'state_id' => 'integer',
        'timezone_offset' => Timezone::class,
        'observes_dst' => 'boolean',
    ];

    public function state(): BelongsTo
    {
        return $this->BelongsTo(State::class);
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
