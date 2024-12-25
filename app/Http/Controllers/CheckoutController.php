<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\UserRoles;
use App\Models\Customer;
use App\Models\Location;
use App\Models\Order;
use App\Models\OrderAdjustable;
use App\Models\OrderExtraPrice;
use App\Models\OrderLineItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        if (! session()->has('cart')) {
            return redirect('/');
        }

        $cart = session('cart') ?? [];
        $locations = Location::all();

        return view('website.checkout', compact('cart', 'locations'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'apartment' => 'nullable|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|confirmed',
            'order_notes' => 'nullable|string',
        ]);

        // Retrieve the cart data from the session
        $cart = session('cart');

        if (! $cart) {
            return redirect('/')->with('error', 'Your cart is empty.');
        }

        $customerUser = User::updateOrCreate(
            ['email' => $validatedData['email']],
            [
                'name' => $validatedData['first_name'].' '.$validatedData['last_name'],
                'role' => UserRoles::CUSTOMER->value,
                'password' => Hash::make($validatedData['password']),
            ]
        );

        // Save the customer details
        $customer = Customer::updateOrCreate(
            ['user_id' => $customerUser->id],
            [
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'country' => $validatedData['country'],
                'street_address' => $validatedData['street_address'],
                'apartment' => $validatedData['apartment'],
                'phone' => $validatedData['phone'],
            ]
        );

        // Save the order details
        $order = Order::create([
            'customer_id' => $customer->id,
            'customer_name' => $customer->first_name.' '.$customer->last_name,
            'email' => $customer->user->email,
            'order_number' => Str::uuid()->toString(),
            'phone' => $customer->phone,
            'order_notes' => $validatedData['order_notes'],
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

        // Redirect the user to a confirmation page
        return redirect()->route('order.confirmation', ['order' => $order->id]);
    }

    public function confirmation(Order $order)
    {
        return view('website.orderConfirmation', compact('order'));
    }
}
