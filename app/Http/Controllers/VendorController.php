<?php

namespace App\Http\Controllers;

class VendorController extends Controller
{
    public function index()
    {
        return view('vendorPanel.dashboard');
    }
}
