<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Resident;
use App\Models\Ride;
use App\Models\TravelSubsidy;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Resident::factory(10)->create();
        Company::factory(2)->create();
        TravelSubsidy::factory(10)->create();
        Ride::factory(20)->create();
    }
}
