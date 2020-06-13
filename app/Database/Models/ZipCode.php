<?php

namespace App\Database\Models;

use App\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class ZipCode extends Model
{
    /**
     * @var string
     */
    public const TABLE = 'zip_codes';

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
        self::CODE => self::STRING,
    ];

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }
}
