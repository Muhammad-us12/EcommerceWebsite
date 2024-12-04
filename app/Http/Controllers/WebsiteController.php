<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;

class WebsiteController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $categoriesWithProducts = Category::with(['products' => function ($query) {
            $query->latest()->take(4);
        }])->get();

        return view('website.index', compact('sliders', 'categoriesWithProducts'));
    }

    public function registerVendor()
    {
        return view('website.registerVendor');
    }

    public function productDetails(Product $product)
    {
        $productGallies = $product->getMedia('gallery');

        return view('website.productDetails', compact('product', 'productGallies'));
    }
}
