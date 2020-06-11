<?php

namespace App\Database\Models;

use App\Database\Eloquent\Model;
use App\Database\Traits\HasUuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Profile extends Model
{
    use HasUuid;

    public const TABLE = 'profiles';

    public const USER = 'user_id';

    public const USERNAME = 'username';

    public const FIRST_NAME = 'first_name';

    public const MIDDLE_NAME = 'middle_name';

    public const LAST_NAME = 'last_name';

    public const PHONE_NUMBER = 'phone';

    public const SEX = 'gender';

    public const BIRTH_DATE = 'birth_date';

    public const SOBRIETY_DATE = 'sobriety_date';

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

    protected $casts = [
        self::ID => self::STRING,
        self::USER => self::STRING,
        self::USERNAME => self::STRING,
        self::FIRST_NAME => self::STRING,
        self::MIDDLE_NAME => self::STRING,
        self::LAST_NAME => self::STRING,
        self::PHONE_NUMBER => self::STRING,
        self::SEX => self::STRING,
        self::BIRTH_DATE => self::DATE.':Y-m-d',
        self::SOBRIETY_DATE => self::DATE.':Y-m-d',
    ];

    protected $dates = [
        self::BIRTH_DATE,
        self::SOBRIETY_DATE,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
