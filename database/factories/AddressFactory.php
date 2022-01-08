<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'street_name'  => $this->faker->streetName,
            'house_number' => $this->faker->numberBetween(1, 100),
            'zipcode'      => $this->faker->postcode(),
            'city'         => $this->faker->city()
        ];
    }
}
