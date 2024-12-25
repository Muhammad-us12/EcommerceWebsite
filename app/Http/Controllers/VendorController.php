<?php

namespace App\Http\Controllers;

use App\Models\Vendor;

class VendorController extends Controller
{
    public function index()
    {
        return view('vendorPanel.dashboard');
    }

    public function allVendorsList()
    {
        $vendors = Vendor::paginate(10);

        return view('adminPanel.vendors.index', compact('vendors'));
    }
}
