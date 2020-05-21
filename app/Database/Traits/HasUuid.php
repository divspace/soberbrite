<?php

namespace App\Database\Traits;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;

trait HasUuid
{
    use GeneratesUuid;

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->whereUuid($value)->firstOrFail();
    }
}
