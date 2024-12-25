<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderAdjustable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderAdjustable>
 */
class OrderAdjustableFactory extends Factory
{
    protected $model = OrderAdjustable::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'adjustable_id' => $this->faker->numberBetween(1, 100),
            'adjustable_value' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
