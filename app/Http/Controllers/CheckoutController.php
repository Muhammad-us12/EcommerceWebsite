<?php

namespace App\Http\Controllers;

use App\Actions\OrderCreate;
use App\Models\Location;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

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

    public function store(Request $request, OrderCreate $orderCreate)
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

        $order = $orderCreate->execute($validatedData);

        // Redirect the user to a confirmation page
        return redirect()->route('order.confirmation', ['order' => $order->id]);
    }

    public function confirmation(Order $order)
    {
        return view('website.orderConfirmation', compact('order'));
    }
}
