<?php

namespace App\Database\Models;

use App\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class AreaCode extends Model
{
    public const TABLE = 'area_codes';

    public const STATE = 'state_id';

    public const CODE = 'code';

    protected $fillable = [
        self::CODE,
    ];

    protected $casts = [
        self::ID => self::INTEGER,
        self::STATE => self::INTEGER,
        self::CODE => self::INTEGER,
    ];

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
