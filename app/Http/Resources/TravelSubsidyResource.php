<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TravelSubsidyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     */
    public function toArray($request): array
    {
        return [
            'resident'   => new ResidentResource($this->resident),
            'distance'   => $this->distance,
            'active'     => $this->active,
            'created_at' => $this->createdAt
        ];
    }
}
