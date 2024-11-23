<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorOnBoardingController extends Controller
{
    public function index()
    {
        $vendor = Auth::user();
        $vendor->vendor;

        return view('vendorPanel.onboarding', compact('vendor'));
    }

    public function store(Request $request)
    {
        $requestData = $request->validate([
            'phone' => ['required', 'string'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string', 'max:255'],
            'cnic' => ['required', 'string', 'size:13', 'unique:vendors,cnic'],
            'gender' => ['required', 'in:male,female,other'],
            'bank_account_number' => ['required', 'string'],
            'bank_name' => ['required', 'string', 'max:255'],
        ]);

        $requestData['user_id'] = Auth::user()->id;
        $vendor = Vendor::create($requestData);

        if ($vendor) {
            return redirect()->back()->with(['success' => 'Details Saved Successfully']);
        } else {
            return redirect()->back()->with(['error' => 'Something Went Wrong Try Again']);
        }
    }

    public function update(Vendor $vendor, Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string', 'max:255'],
            'cnic' => ['required', 'string', 'size:13', 'unique:vendors,cnic,'.$vendor->id],
            'gender' => ['required', 'in:male,female,other'],
            'bank_account_number' => ['required', 'string'],
            'bank_name' => ['required', 'string', 'max:255'],
        ]);

        $vendor->update($request->all());

        if ($vendor) {
            return redirect()->back()->with(['success' => 'Details Updated Successfully']);
        } else {
            return redirect()->back()->with(['error' => 'Something Went Wrong Try Again']);
        }
    }
}
