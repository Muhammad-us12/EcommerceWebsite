<?php

namespace App\Http\Controllers;

use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductAttributeController extends Controller
{
    public function getAllProductAttributes()
    {
        $productAttributes = ProductAttribute::all();

        return view('adminPanel.productAttributes.productAttributes', ['productAttributes' => $productAttributes]);
    }

    public function getProductAttribute(ProductAttribute $productAttribute)
    {

        return response()->json([
            'error' => false,
            'data' => [
                'productAttribute' => $productAttribute,
            ],
        ]);
    }

    public function addProductAttribute(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:product_attributes,name'],
        ]);

        $ProductAttribute = ProductAttribute::create([
            'name' => $request->name,
            'user_id' => Auth::user()->id,
        ]);

        if ($ProductAttribute) {
            return redirect()->back()->with(['success' => 'Product Attribute Added Successfully']);
        } else {
            return redirect()->back()->with(['error' => 'Something Went Wrong Try Again']);
        }
    }

    public function updateProductAttribute(Request $request)
    {
        $request->validate([
            'productAttributeId' => ['required', 'exists:product_attributes,id'],
            'name' => ['required', 'string', 'unique:product_attributes,name'],
        ]);

        $productAttribute = ProductAttribute::find($request->productAttributeId)->update([
            'name' => $request->name,
            'user_id' => Auth::user()->id,
        ]);

        if ($productAttribute) {
            return redirect()->back()->with(['success' => 'Product Attribute Updated Successfully']);
        } else {
            return redirect()->back()->with(['error' => 'Something Went Wrong Try Again']);
        }
    }
}
