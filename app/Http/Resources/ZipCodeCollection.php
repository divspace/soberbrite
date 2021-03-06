<?php

declare(strict_types = 1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

final class ZipCodeCollection extends ResourceCollection
{
    /**
     * @var string
     */
    public $collects = ZipCodeResource::class;

    /**
     * @param Request $request
     */
    public function toArray($request): array
    {
        return [
            'data' => $this->collection,
        ];
    }
}
