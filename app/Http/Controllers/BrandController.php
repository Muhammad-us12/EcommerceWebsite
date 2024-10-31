<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    public function getAllBrands()
    {
        $brands = Brand::all();

        return view('adminPanel.brands.brands', ['brands' => $brands]);
    }

    public function getBrand(Brand $brand)
    {

        return response()->json([
            'error' => false,
            'data' => [
                'brand' => $brand,
            ],
        ]);
    }

    public function addBrand(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:brands,name'],
        ]);

        $Brand = Brand::create([
            'name' => $request->name,
            'user_id' => Auth::user()->id,
        ]);

        if ($Brand) {
            return redirect()->back()->with(['success' => 'Brand Added Successfully']);
        } else {
            return redirect()->back()->with(['error' => 'Something Went Wrong Try Again']);
        }
    }

    public function updateBrand(Request $request)
    {
        $request->validate([
            'brandId' => ['required', 'exists:brands,id'],
            'name' => ['required', 'string', 'unique:brands,name'],
        ]);

        $Brand = Brand::find($request->brandId)->update([
            'name' => $request->name,
            'user_id' => Auth::user()->id,
        ]);

        if ($Brand) {
            return redirect()->back()->with(['success' => 'Brand Updated Successfully']);
        } else {
            return redirect()->back()->with(['error' => 'Something Went Wrong Try Again']);
        }
    }
}
