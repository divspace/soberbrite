<?php

namespace App\Database\Models;

use App\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class AreaCode extends Model
{
    /**
     * @var string
     */
    public const TABLE = 'area_codes';

    /**
     * @var string
     */
    public const STATE = 'state_id';

    /**
     * @var string
     */
    public const CODE = 'code';

    /**
     * @var string[]
     */
    protected $fillable = [
        self::CODE,
    ];

    /**
     * @var array
     */
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
