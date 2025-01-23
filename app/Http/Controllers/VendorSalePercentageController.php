<?php

namespace App\Http\Controllers;

use App\Models\VendorSalePercentage;
use Illuminate\Http\Request;

class VendorSalePercentageController extends Controller
{
    public function index()
    {
        $percentages = VendorSalePercentage::orderBy('id', 'desc')->paginate(10);

        return view('adminPanel.vendorSalePercentages.index', compact('percentages'));
    }

    public function create()
    {
        return view('adminPanel.vendorSalePercentages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'percentage' => 'required|numeric|min:0|max:100',
        ]);

        // Disable all existing entries
        VendorSalePercentage::where('status', 'active')->update(['status' => 'disabled']);

        // Create new entry
        VendorSalePercentage::create([
            'percentage' => $request->percentage,
            'status' => 'active',
        ]);

        return redirect()->route('vendorSalePercentages.index')->with('success', 'Vendor Sale Percentage created successfully.');
    }

    public function edit(VendorSalePercentage $vendorSalePercentage)
    {
        return view('adminPanel.vendorSalePercentages.edit', compact('vendorSalePercentage'));
    }

    public function update(Request $request, VendorSalePercentage $vendorSalePercentage)
    {
        $request->validate([
            'percentage' => 'required|numeric|min:0|max:100',
        ]);

        // Disable all existing entries
        VendorSalePercentage::where('status', 'active')->update(['status' => 'disabled']);

        // Create new entry
        VendorSalePercentage::create([
            'percentage' => $request->percentage,
            'status' => 'active',
        ]);

        return redirect()->route('vendorSalePercentages.index')->with('success', 'Vendor Sale Percentage updated successfully.');
    }

    public function destroy(VendorSalePercentage $vendorSalePercentage)
    {
        $vendorSalePercentage->delete();

        return redirect()->route('vendorSalePercentages.index')->with('success', 'Vendor Sale Percentage deleted successfully.');
    }
}
