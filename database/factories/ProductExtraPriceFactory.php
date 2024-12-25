<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductExtraPrice>
 */
class ProductExtraPriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'price_id' => fake()->randomNumber(9),
            'value' => fake()->randomNumber(9),
            'product_id' => fake()->randomNumber(9),
        ];
    }
}
