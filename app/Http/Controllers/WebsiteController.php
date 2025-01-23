<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Carbon\Carbon;

class WebsiteController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $categoriesWithProducts = Category::whereNull('parent_id')->with(['products' => function ($query) {
            $query->latest()->take(4);
        }])->get();

        return view('website.index', compact('sliders', 'categoriesWithProducts'));
    }

    public function categoryProducts(Category $category)
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();

        $products = Product::where('category_id', $category->id)
            ->where('display_on_website', 1)
            ->orderBy('id', 'desc')->paginate(20);

        return view('website.productsWithCategory', compact('products', 'category', 'categories'));
    }

    public function subCategoryProducts(Category $category)
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();

        $products = Product::where('subcategory_id', $category->id)
            ->where('display_on_website', 1)
            ->orderBy('id', 'desc')->paginate(20);

        return view('website.productsWithCategory', compact('products', 'category', 'categories'));
    }

    public function registerVendor()
    {
        return view('website.registerVendor');
    }

    public function productDetails(Product $product)
    {
        $productGallies = $product->getMedia('gallery');
        $currentDate = date('Y-m-d');
        $dateAfter12Months = Carbon::now()->addMonths(12);
        $dateAfter12Months = $dateAfter12Months->format('Y-m-d');

        return view('website.productDetails', compact('product', 'productGallies', 'currentDate', 'dateAfter12Months'));
    }
}
