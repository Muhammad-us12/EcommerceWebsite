<?php

namespace App\Http\Controllers;

use App\Actions\CreateProduct;
use App\Actions\UpdateProduct;
use App\Enums\UserRoles;
use App\Http\Requests\ProductUpdateValidation;
use App\Http\Requests\ProductValidation;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(10);
        $categories = Category::whereNull('parent_id')->get();
        $brands = Brand::all();
        $vendors = User::where('role', UserRoles::VENDOR)->get();
        $productAttributes = ProductAttribute::all();

        return view('adminPanel.product.index', compact('products', 'categories', 'brands', 'productAttributes', 'vendors'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductValidation $request, CreateProduct $createProduct)
    {
        $validatedData = $request->validated();
        if (! isset($validatedData['user_id'])) {
            $validatedData['user_id'] = Auth::id();
        }

        $product = $createProduct->execute($validatedData, $request);

        if ($product) {
            return redirect()->back()->with('success', 'Product Added Successfully');
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong Try Again');
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
        $productGalley = $product->getMedia('gallery');

        return view('adminPanel.product.gallery', compact('productGalley', 'product'));
    }

    public function deleteGalleryImage(Media $media)
    {
        if ($media) {
            $media->delete();

            return redirect()->back()->with(['success' => 'Image Deleted Successfully']);
        }

        return redirect()->back()->with(['error' => 'Something Went Wrong Try Again']);

    }

    public function show(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::whereNull('parent_id')->get();
        $subCategories = Category::where('parent_id', $product->category_id)->get();
        $brands = Brand::all();
        $productAttributes = ProductAttribute::all();
        $vendors = User::where('role', UserRoles::VENDOR)->get();

        return view('adminPanel.product.edit', compact('product', 'categories', 'subCategories', 'brands', 'productAttributes', 'vendors'));
    }

    public function update(Product $product, ProductUpdateValidation $request, UpdateProduct $updateProduct)
    {
        $validatedRequest = $request->validated();

        if (! isset($validatedRequest['user_id'])) {
            $validatedRequest['user_id'] = Auth::id();
        }

        $updateProduct->execute($product, $validatedRequest, $request);

        if ($product) {
            return redirect()->back()->with(['success' => 'Product Updated Successfully']);
        } else {
            return redirect()->back()->with(['error' => 'Something Went Wrong Try Again']);
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
