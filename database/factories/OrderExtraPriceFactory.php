<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderExtraPrice;
use App\Models\ProductExtraPrice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderExtraPrice>
 */
class OrderExtraPriceFactory extends Factory
{
    protected $model = OrderExtraPrice::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'extra_price_id' => ProductExtraPrice::factory(),
            'value' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
