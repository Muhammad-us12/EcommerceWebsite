<?php

namespace App\Http\Controllers;

use App\Models\ExtraPrices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExtraPricesController extends Controller
{
    public function getAllExtraPrices()
    {
        $extraPrices = ExtraPrices::all();

        return view('adminPanel.extraPrices.extraPrices', ['extraPrices' => $extraPrices]);
    }

    public function getExtraPrices(ExtraPrices $extraPrice)
    {

        return response()->json([
            'error' => false,
            'data' => [
                'extraPrices' => $extraPrice,
            ],
        ]);
    }

    public function addExtraPrices(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:extra_prices,name'],
        ]);

        $extraPrices = ExtraPrices::create([
            'name' => $request->name,
            'user_id' => Auth::user()->id,
        ]);

        if ($extraPrices) {
            return redirect()->back()->with(['success' => 'Extra Price Added Successfully']);
        } else {
            return redirect()->back()->with(['error' => 'Something Went Wrong Try Again']);
        }
    }

    public function updateExtraPrices(Request $request)
    {
        $request->validate([
            'extraPriceId' => ['required', 'exists:extra_prices,id'],
            'name' => ['required', 'string', 'unique:extra_prices,name'],
        ]);

        $extraPrices = ExtraPrices::find($request->extraPriceId)->update([
            'name' => $request->name,
            'user_id' => Auth::user()->id,
        ]);

        if ($extraPrices) {
            return redirect()->back()->with(['success' => 'Extra Price Updated Successfully']);
        } else {
            return redirect()->back()->with(['error' => 'Something Went Wrong Try Again']);
        }
    }
}
