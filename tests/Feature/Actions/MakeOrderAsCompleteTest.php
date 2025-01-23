<?php

namespace Tests\Unit\Actions;

use App\Actions\MakeOrderAsComplete;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderLineItem;
use App\Models\Party;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorSalePercentage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MakeOrderAsCompleteTest extends TestCase
{
    use RefreshDatabase;

    public function testExecute()
    {
        $vendorSalePercentage = VendorSalePercentage::factory()->create(['status' => 'active', 'percentage' => 10]);
        $user = User::factory()->create();

        $vendorUser = User::factory()->create();
        $customerUser = User::factory()->create();

        $vendor = Vendor::factory()->create(['user_id' => $vendorUser->id]);
        $vendorParty = Party::factory([
            'partyable_id' => $vendor->id,
            'partyable_type' => Vendor::class,
            'opening_balance' => 0,
            'balance' => 0,
        ])->create();

        $customer = Customer::factory()->create(['user_id' => $customerUser->id]);
        $customerParty = Party::factory([
            'partyable_id' => $customer->id,
            'partyable_type' => Customer::class,
            'opening_balance' => 500,
            'balance' => 500,
        ])->create();

        $order = Order::factory(['customer_id' => $customer->id])->create();
        $product = Product::factory(['user_id' => $vendorUser->id])->create();

        $orderLineItem = OrderLineItem::factory([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'price_for_total_days' => 1000,
            'security_deposit' => 2000,
        ])->create();

        $makeOrderAsComplete = new MakeOrderAsComplete;
        $makeOrderAsComplete->execute($order);

        $this->assertDatabaseHas('vendor_earn_sale_percentages', [
            'receivable_amount' => 100,
            'vendor_id' => $vendorUser->vendor->id,
            'sale_percentage_id' => $vendorSalePercentage->id,
            'order_id' => $order->id,
        ]);

        $this->assertDatabaseHas('parties', [
            'id' => $customerParty->id,
            'balance' => -1500,
        ]);

        $this->assertDatabaseHas('party_ledgers', [
            'party_id' => $customerParty->id,
            'payment' => 2000,
            'remarks' => 'Security Deposit Released',
            'balance' => -1500,
        ]);

        $this->assertDatabaseHas('parties', [
            'id' => $vendorParty->id,
            'balance' => -100,
        ]);

        $this->assertDatabaseHas('party_ledgers', [
            'party_id' => $vendorParty->id,
            'payment' => 100,
            'balance' => -100,
        ]);

    }
}
