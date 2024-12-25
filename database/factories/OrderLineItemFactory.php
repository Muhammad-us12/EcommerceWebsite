<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderLineItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderLineItem>
 */
class OrderLineItemFactory extends Factory
{
    protected $model = OrderLineItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'product_id' => Product::factory(),
            'quantity' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'price_for_total_days' => $this->faker->randomFloat(2, 100, 1000),
            'security_deposit' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
