<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'category_id' => Category::factory(),
            'subcategory_id' => Category::factory(),
            'brand_id' => Brand::factory(),
            'price' => fake()->numberBetween(100, 500),
            'rent_for_days' => fake()->numberBetween(1, 30),
            'cost_price' => fake()->numberBetween(50, 200),
            'quantity' => fake()->numberBetween(1, 10),
            'security_deposit' => fake()->numberBetween(100, 300),
            'user_id' => User::factory(),
        ];
    }
}
