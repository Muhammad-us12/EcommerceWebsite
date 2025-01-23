<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PartyFactory extends Factory
{
    public function definition(): array
    {
        $openingBalance = fake()->randomNumber(3);

        return [
            'partyable_id' => fake()->randomNumber(),
            'partyable_type' => fake()->randomElements([Customer::class, Vendor::class])[0],
            'opening_balance' => $openingBalance,
            'balance' => $openingBalance,
        ];
    }
}
