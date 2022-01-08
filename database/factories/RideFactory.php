<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Resident;
use Illuminate\Database\Eloquent\Factories\Factory;

class RideFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'resident_id'         => $this->faker->numberBetween(1, Resident::count()),
            'pickup_address_id'   => Address::factory(),
            'drop_off_address_id' => Address::factory(),
            'distance'            => $this->faker->numberBetween(1, 100),
            'pickup_date'         => $this->faker->dateTimeBetween('now', '+7 days')
        ];
    }
}
