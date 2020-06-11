<?php

namespace App\Database\Models;

use App\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class State extends Model
{
    public const TABLE = 'states';

    public const CODE = 'code';

    public const NAME = 'name';

    protected $fillable = [
        self::CODE,
        self::NAME,
    ];

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
