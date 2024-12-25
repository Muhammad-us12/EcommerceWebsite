<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'asc')->paginate(10);

        return view('adminPanel.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('adminPanel.orders.show', compact('order'));
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'orderId' => 'required|exists:orders,id',
            'status' => 'required|in:'.implode(',', array_column(OrderStatus::cases(), 'value')),
        ]);

        $order = Order::find($request->orderId);
        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}
