<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResidentResource;
use App\Models\Address;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ResidentController extends Controller
{
    public function index(): Response
    {
        return response(ResidentResource::collection(Resident::all()));
    }

    public function store(Request $request): Response
    {
        $validator = Validator::make($request->toArray(), [
            'address'      => 'required',
            'name'         => 'required|max:255',
            'email'        => 'required|unique:residents',
            'phone_number' => 'required|max:15'
        ]);

        if ($validator->fails()) {
            return response([
                                'status_code' => 400,
                                'errors'      => $validator->errors()
                            ], 400);
        }

        $address = Address::getExistingAddress($request->input('address.house_number'), $request->input('address.zipcode'));

        if ($address === null) {
            $address = Address::create($request->input('address'));
        }

        $resident = Resident::create([
                                         'name'         => $request->input('name'),
                                         'email'        => $request->input('email'),
                                         'phone_number' => $request->input('phone_number'),
                                         'address_id'   => $address->id
                                     ]);

        return response(new ResidentResource($resident), 201);
    }

    public function show(Resident $resident): Response
    {
        return response(new ResidentResource($resident));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
