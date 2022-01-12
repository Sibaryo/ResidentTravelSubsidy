<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
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
            'company_name' => $this->faker->unique()->company(),
            'email'        => $this->faker->unique()->companyEmail(),
            'phone_number' => $this->faker->unique()->phoneNumber(),
        ];
    }
}
