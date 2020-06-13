<?php

namespace App\Database\Models;

use App\Database\Casts\Timezone;
use App\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Location extends Model
{
    /**
     * @var string
     */
    public const TABLE = 'locations';

    /**
     * @var string
     */
    public const CITY = 'city_id';

    /**
     * @var string
     */
    public const STATE = 'state_id';

    /**
     * @var string
     */
    public const ZIP_CODE = 'zip_code_id';

    /**
     * @var string
     */
    public const LATITUDE = 'latitude';

    /**
     * @var string
     */
    public const LONGITUDE = 'longitude';

    /**
     * @var string
     */
    public const OBSERVES_DST = 'observes_dst';

    /**
     * @var string
     */
    public const TIMEZONE_OFFSET = 'timezone_offset';

    /**
     * @var string[]
     */
    protected $fillable = [
        self::LATITUDE,
        self::LONGITUDE,
        self::TIMEZONE_OFFSET,
        self::OBSERVES_DST,
    ];

    /**
     * @var array
     */
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
