<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class VendorOrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Get orders where the products belong to the authenticated user
        $orders = Order::whereHas('lineItems.product', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        return view('customerPanel.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $customer = Auth::user()->customer;
        if ($order->customer_id !== $customer->id) {
            abort(401, 'Cannot Access This');
        }

        return view('customerPanel.orders.show', compact('order'));
    }
}
