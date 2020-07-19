<?php

namespace App\Database\Models;

use App\Database\Eloquent\Model;

final class FamilyGroup extends Model
{
    /**
     * @var string
     */
    public const TABLE = 'family_groups';

    /**
     * @var string
     */
    public const NAME = 'name';

    /**
     * @var string
     */
    public const ABBREVIATION = 'abbreviation';

    /**
     * @var string[]
     */
    protected $fillable = [
        self::NAME,
        self::ABBREVIATION,
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        self::ID => self::INTEGER,
        self::NAME => self::STRING,
        self::ABBREVIATION => self::STRING,
    ];
}
