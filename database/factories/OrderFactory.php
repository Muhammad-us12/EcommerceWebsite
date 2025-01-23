<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'customer_name' => $this->faker->name,
            'order_number' => $this->faker->unique()->randomNumber(),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'order_notes' => $this->faker->sentence,
            'sub_total' => $this->faker->randomFloat(2, 100, 1000),
            'extra_service_total' => $this->faker->randomFloat(2, 10, 100),
            'discount' => $this->faker->randomFloat(2, 0, 50),
            'total_price' => $this->faker->randomFloat(2, 100, 1000),
            'status' => OrderStatus::PENDING->value,
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'total_days' => $this->faker->numberBetween(1, 30),
        ];
    }
}
