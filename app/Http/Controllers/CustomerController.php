<?php

namespace App\Http\Controllers;

use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {

        return view('customerPanel.dashboard');
    }

    public function allCustomersList()
    {
        $customers = Customer::paginate(10);

        return view('adminPanel.customers.index', compact('customers'));
    }
}
