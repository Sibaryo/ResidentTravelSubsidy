<?php

namespace App\Http\Controllers;

use App\Models\TravelSubsidy;
use DateTime;

class TravelSubsidyController extends Controller
{
    public function findRenewableSubsidies()
    {
        $date = new DateTime('today -1 year');

        return TravelSubsidy::where('active', 1)
            ->whereBetween('updated_at', [$date->format('Y-m-d'), $date->setTime(23, 59)]);
    }
}
