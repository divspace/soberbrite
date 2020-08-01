<?php

declare(strict_types = 1);

namespace App\Database\Models;

use App\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Profile extends Model
{
    /**
     * @var string
     */
    public const TABLE = 'profiles';

    /**
     * @var string
     */
    public const USER = 'user_id';

    /**
     * @var string
     */
    public const USERNAME = 'username';

    /**
     * @var string
     */
    public const FIRST_NAME = 'first_name';

    /**
     * @var string
     */
    public const MIDDLE_NAME = 'middle_name';

    /**
     * @var string
     */
    public const LAST_NAME = 'last_name';

    /**
     * @var string
     */
    public const PHONE_NUMBER = 'phone';

    /**
     * @var string
     */
    public const SEX = 'gender';

    /**
     * @var string
     */
    public const BIRTH_DATE = 'birth_date';

    /**
     * @var string
     */
    public const SOBRIETY_DATE = 'sobriety_date';

    /**
     * @var string[]
     */
    protected $fillable = [
        self::USERNAME,
        self::FIRST_NAME,
        self::MIDDLE_NAME,
        self::LAST_NAME,
        self::PHONE_NUMBER,
        self::SEX,
        self::BIRTH_DATE,
        self::SOBRIETY_DATE,
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        self::ID => self::INTEGER,
        self::USER => self::INTEGER,
        self::USERNAME => self::STRING,
        self::FIRST_NAME => self::STRING,
        self::MIDDLE_NAME => self::STRING,
        self::LAST_NAME => self::STRING,
        self::PHONE_NUMBER => self::STRING,
        self::SEX => self::STRING,
        self::BIRTH_DATE => self::DATE.':Y-m-d',
        self::SOBRIETY_DATE => self::DATE.':Y-m-d',
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        self::BIRTH_DATE,
        self::SOBRIETY_DATE,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
