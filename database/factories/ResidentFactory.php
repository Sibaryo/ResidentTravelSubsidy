<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'address_id'   => Address::factory(),
            'name'         => $this->faker->unique()->name(),
            'email'        => $this->faker->unique()->email(),
            'phone_number' => $this->faker->unique()->phoneNumber(),
        ];
    }
}
