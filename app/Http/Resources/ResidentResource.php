<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResidentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     */
    public function toArray($request): array
    {
        return [
            'name'         => $this->name,
            'email'        => $this->email,
            'phone_number' => $this->phone_number,
            'address'      => new AddressResource($this->address)
        ];
    }
}
