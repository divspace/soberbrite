<?php

namespace App\Database\Models;

use App\Database\Models\Location;
use App\Database\Models\User;
use App\Database\Traits\HasTimestamps;
use App\Database\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasTimestamps, HasUuid;

    protected $fillable = [
        'street',
    ];

    protected $casts = [
        'id' => Uuid::class,
        'user_id' => Uuid::class,
        'location_id' => 'integer',
        'street' => 'string',
    ];

    public function city(): string
    {
        return $this->location->city->name;
    }

    public function state(): string
    {
        return $this->location->state->name;
    }

    public function zipCode(): string
    {
        return $this->location->zipCode->code;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
