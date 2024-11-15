<?php

namespace App\Http\Controllers;

use App\Models\Slider;

class WebsiteController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();

        return view('website.index', compact('sliders'));
    }

    public function registerVendor()
    {
        return view('website.registerVendor');
    }
}
