<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     */
    public function toArray($request): array
    {
        $rides = [];
        foreach (Ride::with('company')->where('company_id', $this->id)->get() as $ride) {
            $rides[] = new RideResource($ride);
        }

        return [
            'company_name' => $this->company_name,
            'email'        => $this->email,
            'phone_number' => $this->phone_number,
            'address'      => new AddressResource($this->address),
            'rides'        => $rides
        ];
    }
}
