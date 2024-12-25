<?php

namespace App\Http\Controllers;

use App\Models\CustomerPaymentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerPaymentRequestController extends Controller
{
    public function paymentRequests(Request $request)
    {
        $customer = Auth::user()->customer;
        $paymentRequests = $customer->paymentRequest;

        return view('customerPanel.paymentRequest.index', compact('paymentRequests'));
    }

    public function store(Request $request)
    {
        $customer = Auth::user()->customer;
        $validatedData = $request->validate([
            'payment_amount' => 'required|numeric|min:0.01',
            'transaction_id' => 'required|string|max:255',
            'payment_method' => 'required|string|max:50',
            'invoice_no' => 'required|string|exists:orders,order_number',
            'payment_date' => 'required|date',
            'payment_pic' => ['required', 'mimes:jpeg,jpg,png,gif|max:10244'],
        ]);

        $paymentRequest = CustomerPaymentRequest::create([
            'payment_amount' => $request->payment_amount,
            'transaction_id' => $request->transaction_id,
            'payment_method' => $request->payment_method,
            'invoice_no' => $request->invoice_no,
            'payment_date' => $request->payment_date,
            'status' => 'Pending',
            'customer_id' => $customer->id,
        ]);

        if ($paymentRequest) {
            if ($request->hasFile('payment_pic')) {
                $paymentRequest->addMediaFromRequest('payment_pic')->toMediaCollection('image');
            }
        }

        if ($paymentRequest) {
            return redirect()->back()->with('success', 'Screen Shot upload Successfully');
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong Try Again');
        }
    }

    public function allPaymentRequestsList()
    {
        $payments_request_data = CustomerPaymentRequest::orderBy('id', 'desc')->paginate(10);

        return view('adminPanel/paymentRequest/index', compact('payments_request_data'));
    }

    public function update_payment_status(Request $request)
    {
        $customerPaymentRequest = CustomerPaymentRequest::find($request->payment_id);

        DB::transaction(function () use ($request, $customerPaymentRequest) {

            $customerPaymentRequest->update([
                'status' => $request->payment_status,
                'message' => $request->message,
            ]);
        });

        return redirect()->back()->with(['success' => 'Payment Status Updated Successfully']);

    }
}
