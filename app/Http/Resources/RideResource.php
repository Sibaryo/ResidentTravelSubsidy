<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RideResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     */
    public function toArray($request): array
    {
        return [
            'resident'         => new ResidentResource($this->resident),
            'pickup_address'   => new AddressResource($this->pickUpAddress),
            'drop_off_address' => new AddressResource($this->dropOffAddress),
            'distance'         => $this->distance,
            'pickup_date'      => $this->pickup_date
        ];
    }
}
