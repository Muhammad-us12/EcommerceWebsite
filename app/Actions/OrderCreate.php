<?php

namespace App\Actions;

use App\Enums\OrderStatus;
use App\Enums\UserRoles;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderAdjustable;
use App\Models\OrderExtraPrice;
use App\Models\OrderLineItem;
use App\Models\Party;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OrderCreate
{
    public function execute(array $requestData)
    {
        // Retrieve the cart data from the session
        $cart = session('cart');

        if (! $cart) {
            return redirect('/')->with('error', 'Your cart is empty.');
        }

        return DB::transaction(function () use ($cart, $requestData) {
            $customerUser = User::updateOrCreate(
                ['email' => $requestData['email']],
                [
                    'name' => $requestData['first_name'].' '.$requestData['last_name'],
                    'role' => UserRoles::CUSTOMER->value,
                    'password' => Hash::make($requestData['password']),
                ]
            );

            // Save the customer details
            $customer = Customer::updateOrCreate(
                ['user_id' => $customerUser->id],
                [
                    'first_name' => $requestData['first_name'],
                    'last_name' => $requestData['last_name'],
                    'country' => $requestData['country'],
                    'street_address' => $requestData['street_address'],
                    'apartment' => $requestData['apartment'],
                    'phone' => $requestData['phone'],
                ]
            );

            $party = Party::where('partyable_id', $customer->id)
                ->where('partyable_type', Customer::class)
                ->first();

            if (! $party) {
                Party::create([
                    'partyable_id' => $customer->id,
                    'partyable_type' => Customer::class,
                    'opening_balance' => 0,
                    'balance' => 0,
                ]);
            }

            // Save the order details
            $order = Order::create([
                'customer_id' => $customer->id,
                'customer_name' => $customer->first_name.' '.$customer->last_name,
                'email' => $customer->user->email,
                'order_number' => Str::uuid()->toString(),
                'phone' => $customer->phone,
                'order_notes' => $requestData['order_notes'],
                'sub_total' => $cart['subTotalPrice'],
                'extra_service_total' => $cart['extraServiceTotal'],
                'discount' => $cart['discount'],
                'total_price' => $cart['totalPrice'],
                'status' => OrderStatus::PENDING->value,
                'start_date' => $cart['startDate'],
                'end_date' => $cart['endDate'],
                'total_days' => $cart['totalDays'],
            ]);

            // Save the order line items
            OrderLineItem::create([
                'order_id' => $order->id,
                'product_id' => $cart['product']->id,
                'quantity' => $cart['quantity'],
                'price' => $cart['price'],
                'price_for_total_days' => $cart['priceForTotalDays'],
                'security_deposit' => $cart['securityDeposit'],
            ]);

            // Save the extra prices
            foreach ($cart['extraService'] as $extraService) {
                OrderExtraPrice::create([
                    'order_id' => $order->id,
                    'extra_price_id' => $extraService->id,
                    'value' => $extraService->value,
                ]);
            }

            // Save the adjustable ids and values
            if (isset($cart['adjustableIds']) && ! empty($cart['adjustableIds'])) {
                foreach ($cart['adjustableIds'] as $index => $adjustableId) {
                    OrderAdjustable::create([
                        'order_id' => $order->id,
                        'adjustable_id' => $adjustableId,
                        'adjustable_value' => $cart['adjustableValues'][$index],
                    ]);
                }
            }

            $partyData = [
                'partyId' => $customer->party->id,
                'amount' => $order->total_price,
                'incrementType' => 'increment',
                'dbFeildId' => 'order_id',
                'dbFeild' => 'received',
                'orderId' => $order->id,
                'remarks' => 'New Order Placed',
                'date' => now(),
            ];

            $this->updateCustomerBalance($partyData);

            return $order;

        });

    }

    private function updateCustomerBalance(array $partyData)
    {
        // Update Party Balance
        $updatePartyBalance = app(UpdatePartyBalance::class);
        $updatePartyBalance->execute($partyData['partyId'], $partyData['amount'], $partyData['incrementType']);

        // Insert Party Ledger
        $SavePartyLedger = app(SavePartyLedger::class);
        $SavePartyLedger->execute($partyData['partyId'], $partyData['amount'], $partyData['dbFeildId'], $partyData['dbFeild'], $partyData['orderId'], $partyData['remarks'], date: $partyData['date']);
    }
}
