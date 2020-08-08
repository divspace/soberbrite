<?php

declare(strict_types = 1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class LocationResource extends JsonResource
{
    /**
     * @param Request $request
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'city' => (new CityResource($this->city)),
            'state' => (new StateResource($this->state)),
            'zipCode' => (new ZipCodeResource($this->zipCode)),
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'timezone_offset' => $this->timezone_offset,
            'observes_dst' => $this->observes_dst,
        ];
    }
}
