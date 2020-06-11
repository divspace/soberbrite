<?php

namespace App\Database\Models;

use App\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class ZipCode extends Model
{
    public const TABLE = 'zip_codes';

    public const CODE = 'code';

    protected $fillable = [
        self::CODE,
    ];

    protected $casts = [
        self::ID => self::INTEGER,
        self::CODE => self::STRING,
    ];

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }
}
