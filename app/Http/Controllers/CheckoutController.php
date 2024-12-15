<?php

namespace App\Http\Controllers;

use App\Models\Location;

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
}
