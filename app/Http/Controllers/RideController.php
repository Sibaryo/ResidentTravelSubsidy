<?php

namespace App\Http\Controllers;

use App\Http\Resources\RideResource;
use App\Models\Address;
use App\Models\Resident;
use App\Models\Ride;
use App\Models\TravelSubsidy;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class RideController extends Controller
{
    public function index(): Response
    {
        return response(RideResource::collection(Ride::all()));
    }

    public function store(Request $request): Response
    {
        $validate = Validator::make($request->toArray(), [
            'resident'         => 'required',
            'pickup_address'   => 'required',
            'drop_off_address' => 'required',
            'distance'         => 'required',
            'pickup_date'      => 'required'
        ]);

        if ($validate->fails()) {
            return response(['status_code' => 400, 'errors' => $validate->errors()], 400);
        }

        $address = Address::getExistingAddress($request->input('resident.address.house_number'), $request->input('resident.address.zipcode'));
        if ($address === null) {
            $address = Address::create($request->input('address'));
        }

        $resident = Resident::getExistingResident($request->input('resident.email'));
        if ($resident === null) {
            $resident = Resident::create([
                                             'name'         => $request->input('resident.name'),
                                             'email'        => $request->input('resident.email'),
                                             'phone_number' => $request->input('resident.phone_number'),
                                             'address_id'   => $address->id
                                         ]);
        }

        // Checking if the resident has a valid subsidy
        $subsidy = TravelSubsidy::getValidSubsidy($resident->id);
        if ($subsidy === null || $subsidy->updated_at->addYear(1) < Carbon::now()) {
            return response(['status_code' => 403, 'error' => 'resident has invalid or no subsidy'], 403);
        }

        // Checking if the resident has any budget / distance left
        $usedDistance = (int)Ride::where('resident_id', $resident->id)
            ->whereBetween('created_at', [$subsidy->updated_at, new Datetime()])
            ->sum('distance');

        if (($usedDistance + $request->input('distance')) > $subsidy->distance) {
            return response(['status_code' => 406, 'error' => 'resident has not enough budget / distance'], 406);
        }

        $pickupAddress = Address::getExistingAddress($request->input('pickup_address.house_number'), $request->input('pickup_address.zipcode'));
        if ($pickupAddress === null) {
            $pickupAddress = Address::create($request->input('pickup_address'));
        }

        $dropOffAddress = Address::getExistingAddress($request->input('drop_off_address.house_number'), $request->input('drop_off_address.zipcode'));
        if ($dropOffAddress === null) {
            $dropOffAddress = Address::create($request->input('drop_off_address'));
        }

        $ride = Ride::create([
                                 'resident_id'         => $resident->id,
                                 'pickup_address_id'   => $pickupAddress->id,
                                 'drop_off_address_id' => $dropOffAddress->id,
                                 'address_id'          => $address->id,
                                 'distance'            => $request->input('distance'),
                                 'pickup_date'         => $request->date('pickup_date'),
                             ]);

        return response(new RideResource($ride), 201);
    }

    public function show(Ride $ride): Response
    {
        return response(new RideResource($ride));
    }
}
