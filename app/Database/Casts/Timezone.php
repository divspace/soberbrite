<?php

namespace App\Database\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Str;

final class Timezone implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): string
    {
        return Str::beforeLast($value, ':');
    }

    public function set($model, string $key, $value, array $attributes): string
    {
        return $value;
    }
}
