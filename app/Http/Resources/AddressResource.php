<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     */
    public function toArray($request): array
    {
        return [
            'street_name'  => $this->street_name,
            'house_number' => $this->house_number,
            'zipcode'      => $this->zipcode,
            'city'         => $this->city,
        ];
    }
}
