<?php

namespace App\Database\Models;

use App\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class State extends Model
{
    /**
     * @var string
     */
    public const TABLE = 'states';

    /**
     * @var string
     */
    public const CODE = 'code';

    /**
     * @var string
     */
    public const NAME = 'name';

    /**
     * @var string[]
     */
    protected $fillable = [
        self::CODE,
        self::NAME,
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        self::ID => self::INTEGER,
        self::CODE => self::STRING,
        self::NAME => self::STRING,
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
