<?php

namespace App\Database\Models;

use App\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgramType extends Model
{
    public const TABLE = 'program_types';

    public const NAME = 'name';

    protected $fillable = [
        self::NAME,
    ];

    protected $casts = [
        self::ID => self::INTEGER,
        self::NAME => self::STRING,
    ];

    public function programs(): HasMany
    {
        return $this->hasMany(Program::class);
    }
}
