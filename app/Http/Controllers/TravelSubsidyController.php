<?php

namespace App\Http\Controllers;

use App\Http\Resources\TravelSubsidyResource;
use App\Models\Address;
use App\Models\Resident;
use App\Models\TravelSubsidy;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class TravelSubsidyController extends Controller
{
    public function findRenewableSubsidies()
    {
        $date = new DateTime('today -1 year');

        return TravelSubsidy::where('active', 1)
            ->whereBetween('updated_at', [$date->format('Y-m-d'), $date->setTime(23, 59)]);
    }

    public function store(Request $request): Response
    {
        $validate = Validator::make($request->toArray(), [
            'resident' => 'required',
            'distance' => 'required',
            'active'   => 'required'
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

        $subsidy = TravelSubsidy::getValidSubsidy($resident->id);
        if ($subsidy === null || $subsidy->updated_at->addYear(1) < Carbon::now()) {
            $subsidy = TravelSubsidy::create([
                                                 'resident_id' => $resident->id,
                                                 'distance'    => $request->input('distance'),
                                                 'active'      => $request->input('active')
                                             ]);
        }

        return response(new TravelSubsidyResource($subsidy), 201);
    }
}
