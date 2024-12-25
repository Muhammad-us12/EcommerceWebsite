<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CustomerOrderController extends Controller
{
    public function index()
    {
        $customer = Auth::user()->customer;
        $orders = $customer->orders;

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
