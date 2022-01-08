<?php

namespace Database\Factories;

use App\Models\Resident;
use Illuminate\Database\Eloquent\Factories\Factory;

class TravelSubsidyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'resident_id' => Resident::factory(),
            'distance'    => $this->faker->numberBetween(1000, 10000),
            'active'      => 1,
        ];
    }
}
