<?php

namespace App\Database\Models;

use App\Database\Casts\Timezone;
use App\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Location extends Model
{
    public const TABLE = 'locations';

    public const CITY = 'city_id';

    public const STATE = 'state_id';

    public const ZIP_CODE = 'zip_code_id';

    public const LATITUDE = 'latitude';

    public const LONGITUDE = 'longitude';

    public const OBSERVES_DST = 'observes_dst';

    public const TIMEZONE_OFFSET = 'timezone_offset';

    protected $fillable = [
        self::LATITUDE,
        self::LONGITUDE,
        self::TIMEZONE_OFFSET,
        self::OBSERVES_DST,
    ];

    protected $casts = [
        self::ID => self::INTEGER,
        self::CITY => self::INTEGER,
        self::STATE => self::INTEGER,
        self::ZIP_CODE => self::INTEGER,
        self::LATITUDE => self::FLOAT,
        self::LONGITUDE => self::FLOAT,
        self::TIMEZONE_OFFSET => Timezone::class,
        self::OBSERVES_DST => self::BOOLEAN,
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function zipCode(): BelongsTo
    {
        return $this->belongsTo(ZipCode::class);
    }
}
