<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendor>
 */
class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'phone' => $this->faker->numerify('##########'),
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'cnic' => $this->faker->numerify('#############'),
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'bank_account_number' => $this->faker->numerify('###############'),
            'bank_name' => $this->faker->company,
        ];
    }
}
