<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(10);
        $categories = Category::whereNull('parent_id')->get();
        $brands = Brand::all();
        $productAttributes = ProductAttribute::all();

        return view('adminPanel.product.index', compact('products', 'categories', 'brands', 'productAttributes'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $requestData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'subcategory_id' => ['required', 'integer', 'exists:categories,id'],
            'brand_id' => ['required', 'integer', 'exists:brands,id'],
            'price' => ['required', 'numeric'],
            'cost_price' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
            'security_deposit' => ['required', 'numeric'],
            'vendor_id' => ['nullable', 'string', 'exists:user,id'],
            'thumbnail' => ['required', 'mimes:jpeg,jpg,png,gif|max:10244'],
            'attributes.*' => ['nullable'],
            'attributesId.*' => ['nullable', 'exists:product_attributes,id'],
        ]);

        $requestData['user_id'] = Auth::user()->id;

        $product = Product::create($requestData);

        $product->addMediaFromRequest('thumbnail')->toMediaCollection('image');

        if ($product) {
            return redirect()->back()->with(['success' => 'Product Added Successfully']);
        } else {
            return redirect()->back()->with(['error' => 'Something Went Wrong Try Again']);
        }
    }

    public function saveProductGallery(Product $product, Request $request)
    {
        $request->validate([
            'gallery.*' => ['required', 'mimes:jpeg,jpg,png,gif|max:10244'],
        ]);

        if (isset($request->gallery) && ! empty($request->gallery)) {
            foreach ($request->gallery as $gallery) {
                $product->addMedia($gallery)->toMediaCollection('gallery');
            }
        }

        if ($product) {
            return redirect()->back()->with(['success' => 'Product gallery Added Successfully']);
        } else {
            return redirect()->back()->with(['error' => 'Something Went Wrong Try Again']);
        }
    }

    public function getGallery(Product $product)
    {
        $product->getMedia('gallery');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'subcategory_id' => ['required', 'integer', 'exists:categories,id'],
            'brand_id' => ['required', 'integer', 'exists:brands,id'],
            'price' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
            'security_deposit' => ['required', 'numeric'],
            'vendor_id' => ['nullable', 'string', 'exists:user,id'],
        ]);

        $product = Product::find($request->product_id);
        $product->update($request->all());

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
