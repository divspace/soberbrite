<?php

namespace App\Database\Models;

use App\Database\Traits\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AreaCode extends Model
{
    use HasTimestamps;

    protected $fillable = [
        'code',
    ];

    protected $casts = [
        'id' => 'integer',
        'state_id' => 'integer',
        'code' => 'integer',
    ];

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
