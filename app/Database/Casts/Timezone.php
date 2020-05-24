<?php

namespace App\Database\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Timezone implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): string
    {
        return substr($value, 0, 6);
    }

    public function set($model, string $key, $value, array $attributes): string
    {
        return $value;
    }
}
