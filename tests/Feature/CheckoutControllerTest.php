<?php

namespace Tests\Feature\Controllers;

use App\Enums\OrderStatus;
use App\Models\Location;
use App\Models\Product;
use App\Models\ProductExtraPrice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testDisplayCheckoutPage(): void
    {
        $location = Location::factory()->create();
        $cart = [
            'id' => 23,
            'name' => 'Zeus Kirk',
            'quantity' => 1,
            'extraService' => collect([
                ProductExtraPrice::factory()->create(['value' => 200]),
                ProductExtraPrice::factory()->create(['value' => 300]),
            ]),
            'product' => Product::factory()->create(),
            'price' => 568.0,
            'priceForTotalDays' => 2840.0,
            'securityDeposit' => 30.0,
            'subTotalPrice' => 3370.0,
            'extraServiceTotal' => 500,
            'discount' => 0,
            'totalPrice' => 3370.0,
            'adjustableIds' => [24, 25, 26, 29],
            'adjustableValues' => [10, 21, 29, 58],
            'goodFit' => false,
            'startDate' => '2024-12-25',
            'endDate' => '2024-12-30',
            'totalDays' => 5.0,
        ];

        session(['cart' => $cart]);

        $response = $this->get('/checkout');

        $response->assertOk();
        $response->assertViewIs('website.checkout');
        $response->assertViewHas('cart', $cart);
        $response->assertViewHas('locations', function ($locations) use ($location) {
            return $locations->contains($location);
        });
    }

    public function testSubmitCheckoutFormWithValidData(): void
    {
        $location = Location::factory()->create();
        $cart = [
            'id' => 23,
            'name' => 'Zeus Kirk',
            'quantity' => 1,
            'extraService' => collect([
                ProductExtraPrice::factory()->create(['value' => 200]),
                ProductExtraPrice::factory()->create(['value' => 300]),
            ]),
            'product' => Product::factory()->create(),
            'price' => 568.0,
            'priceForTotalDays' => 2840.0,
            'securityDeposit' => 30.0,
            'subTotalPrice' => 3370.0,
            'extraServiceTotal' => 500,
            'discount' => 0,
            'totalPrice' => 3370.0,
            'adjustableIds' => [24, 25, 26, 29],
            'adjustableValues' => [10, 21, 29, 58],
            'goodFit' => false,
            'startDate' => '2024-12-25',
            'endDate' => '2024-12-30',
            'totalDays' => 5.0,
        ];

        session(['cart' => $cart]);

        $payload = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'company_name' => 'Company Inc.',
            'country' => $location->name,
            'street_address' => '123 Main St',
            'apartment' => 'Apt 4B',
            'phone' => '1234567890',
            'email' => 'john.doe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'order_notes' => 'Please deliver between 9 AM and 5 PM.',
        ];

        $response = $this->post('/checkout', $payload);

        $response->assertRedirect(route('order.confirmation', ['order' => 1]));

        $this->assertDatabaseHas('customers', [
            'first_name' => $payload['first_name'],
            'last_name' => $payload['last_name'],
            'company_name' => $payload['company_name'],
            'country' => $payload['country'],
            'street_address' => $payload['street_address'],
            'apartment' => $payload['apartment'],
            'phone' => $payload['phone'],
            'email' => $payload['email'],
        ]);

        $this->assertDatabaseHas('orders', [
            'customer_id' => 1,
            'customer_name' => $payload['first_name'].' '.$payload['last_name'],
            'email' => $payload['email'],
            'phone' => $payload['phone'],
            'order_notes' => $payload['order_notes'],
            'sub_total' => $cart['subTotalPrice'],
            'extra_service_total' => $cart['extraServiceTotal'],
            'discount' => $cart['discount'],
            'total_price' => $cart['totalPrice'],
            'status' => OrderStatus::PENDING->value,
            'start_date' => $cart['startDate'],
            'end_date' => $cart['endDate'],
            'total_days' => $cart['totalDays'],
        ]);

        $this->assertDatabaseHas('order_line_items', [
            'order_id' => 1,
            'product_id' => $cart['product']->id,
            'quantity' => $cart['quantity'],
            'price' => $cart['price'],
            'price_for_total_days' => $cart['priceForTotalDays'],
            'security_deposit' => $cart['securityDeposit'],
        ]);

        foreach ($cart['extraService'] as $extraService) {
            $this->assertDatabaseHas('order_extra_prices', [
                'order_id' => 1,
                'extra_price_id' => $extraService->id,
                'value' => $extraService->value,
            ]);
        }

        foreach ($cart['adjustableIds'] as $index => $adjustableId) {
            $this->assertDatabaseHas('order_adjustables', [
                'order_id' => 1,
                'adjustable_id' => $adjustableId,
                'adjustable_value' => $cart['adjustableValues'][$index],
            ]);
        }
    }

    public function testSubmitCheckoutFormWithInvalidData(): void
    {
        $location = Location::factory()->create();
        $cart = [
            'id' => 23,
            'name' => 'Zeus Kirk',
            'quantity' => 1,
            'extraService' => collect([
                ProductExtraPrice::factory()->create(['value' => 200]),
                ProductExtraPrice::factory()->create(['value' => 300]),
            ]),
            'product' => Product::factory()->create(),
            'price' => 568.0,
            'priceForTotalDays' => 2840.0,
            'securityDeposit' => 30.0,
            'subTotalPrice' => 3370.0,
            'extraServiceTotal' => 500,
            'discount' => 0,
            'totalPrice' => 3370.0,
            'adjustableIds' => [24, 25, 26, 29],
            'adjustableValues' => [10, 21, 29, 58],
            'goodFit' => false,
            'startDate' => '2024-12-25',
            'endDate' => '2024-12-30',
            'totalDays' => 5.0,
        ];

        session(['cart' => $cart]);

        $payload = [
            'first_name' => '',
            'last_name' => '',
            'company_name' => '',
            'country' => '',
            'street_address' => '',
            'apartment' => '',
            'phone' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
            'order_notes' => '',
        ];

        $response = $this->post('/checkout', $payload);

        $response->assertSessionHasErrors([
            'first_name',
            'last_name',
            'country',
            'street_address',
            'phone',
            'email',
            'password',
        ]);
    }
}
