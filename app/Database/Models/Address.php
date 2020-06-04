<?php

namespace App\Database\Models;

use App\Database\Traits\HasTimestamps;
use App\Database\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Address extends Model
{
    use HasTimestamps, HasUuid;

    protected $fillable = [
        'street',
    ];

    protected $casts = [
        'id' => 'string',
        'user_id' => 'string',
        'location_id' => 'integer',
        'street' => 'string',
    ];

    protected $with = [
        'location',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
