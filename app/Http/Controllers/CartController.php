<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // Retrieve cart items from session or database
        $cartItems = session('cart') ?? [];

        return view('website.cart', compact('cartItems'));
    }

    public function addToCart(Request $request, Product $product, CartService $cartService)
    {
        $request->validate([
            'bookingDates' => ['required', 'string'],
            'selectedExtraPrices' => ['nullable', 'array'],
            'selectedExtraPrices.*' => ['nullable', 'exists:product_extra_prices,id'],
            'goodFit' => ['nullable', 'in:true,false'],
            'adjustableIds' => ['nullable', 'array'],
            'adjustableIds.*' => ['nullable', 'exists:product_assigned_attributes,id'],
            'adjustableValues' => ['nullable', 'array'],
            'adjustableValues.*' => ['nullable', 'numeric'],

        ]);

        // Add product to cart

        $isGoodFit = true;
        if (isset($request->goodFit)) {
            $isGoodFit = $request->goodFit == 'true' ? true : false;
        }

        $cartItem = $cartService->addItem($product, $request->bookingDates, $request->selectedExtraPrices, $isGoodFit, $request->adjustableIds, $request->adjustableValues);
        $cart = session('cart') ?? [];
        $cart = $cartItem;

        // Store updated cart in session
        session(['cart' => $cart]);

        return redirect()->route('checkout.index')->with('success', 'Product added to cart');
    }

    public function removeFromCart(Request $request, $productId)
    {
        // Remove product from cart
        $cart = session('cart') ?? [];
        unset($cart[$productId]);

        // Store updated cart in session
        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Product removed from cart');
    }

    public function updateCart(Request $request)
    {
        // Update product quantities in cart
        $cart = session('cart') ?? [];
        foreach ($request->input('quantity', []) as $productId => $quantity) {
            $cart[$productId] = max(0, (int) $quantity);
        }

        // Store updated cart in session
        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Cart updated');
    }
}
