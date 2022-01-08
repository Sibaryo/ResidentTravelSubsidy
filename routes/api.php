<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\RideController;
use App\Http\Controllers\TravelSubsidyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResources([
                        'residents'        => ResidentController::class,
                        'rides'            => RideController::class,
                        'addresses'        => AddressController::class,
                        'travel_subsidies' => TravelSubsidyController::class
                    ]);
