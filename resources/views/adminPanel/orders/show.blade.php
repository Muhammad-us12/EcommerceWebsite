
<?php
use App\Models\ProductAssignedAttributes;

?>

@extends('adminPanel/master') 
        @section('style')
        <link href="{{ asset('public/adminPanel/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
        @endsection

        @section('sidebare')

        @include('adminPanel/sidebare')
     

        @endsection
@section('content')
<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">eCommerce</a></li>
                            <li class="breadcrumb-item active">Order Details</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Order Details</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-10 col-sm-11">
                <div class="horizontal-steps mt-4 mb-4 pb-5">
                    <div class="horizontal-steps-content">
                        <div class="step-item {{ $order->status == 'pending' ? 'current' : '' }}">
                            <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Pending">Pending</span>
                        </div>
                        <div class="step-item {{ $order->status == 'inprogress' ? 'current' : '' }}">
                            <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="In Progress">In Progress</span>
                        </div>
                        <div class="step-item {{ $order->status == 'dispatch' ? 'current' : '' }}">
                            <span>Dispatched</span>
                        </div>
                        <div class="step-item {{ $order->status == 'delivered' ? 'current' : '' }}">
                            <span>Delivered</span>
                        </div>
                        <div class="step-item {{ $order->status == 'complete' ? 'current' : '' }}">
                            <span>Completed</span>
                        </div>
                    </div>
                    <div class="process-line" style="width: {{ $order->status == 'complete' ? '100%' : ($order->status == 'delivered' ? '75%' : ($order->status == 'dispatch' ? '50%' : ($order->status == 'inprogress' ? '25%' : '0%'))) }};"></div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Items from Order #{{ $order->order_number }}</h4>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Image</th>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $subTotalForAllDays = 0;
                                    @endphp
                                    @foreach($order->lineItems as $item)
                                    <tr>
                                        <td><img src="{{ $item->product->getFirstMediaUrl('image') }}" style="width:100px;" alt=""> </td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>${{ number_format($item->price, 2) }}</td>
                                        <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                    @php
                                        $subTotalForAllDays = $item->price_for_total_days;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div> <!-- end col -->

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Order Summary</h4>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Description</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Rent Date :</td>
                                        <td>{{ date('d-m-Y',strtotime($order->start_date)) }} to {{ date('d-m-Y',strtotime($order->end_date)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Sub Total For {{ $order->total_days }} Days :</td>
                                        <td>PKR {{ $subTotalForAllDays }}</td>
                                    </tr>
                                    <tr>
                                        <td>Extra Service Total :</td>
                                        <td>PKR {{ number_format($order->extra_service_total, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Sub Total :</td>
                                        <td>PKR {{ number_format($order->sub_total, 2) }}</td>
                                    </tr>
                                   
                                    <tr>
                                        <td>Discount :</td>
                                        <td>PKR {{ number_format($order->discount, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total :</th>
                                        <th>PKR {{ number_format($order->total_price, 2) }}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Customer Information</h4>
                        <h5>First Name: {{ $order->customer->first_name }}</h5>
                        <h5>Last Name: {{ $order->customer->last_name }}</h5>
                        <address class="mb-0 font-14 address-lg">
                            {{ $order->customer->street_address }}<br>
                            {{ $order->customer->apartment }}<br>
                            {{ $order->customer->country }}<br>
                            <abbr title="Phone">P:</abbr> {{ $order->customer->phone }} <br />
                            <abbr title="Email">E:</abbr> {{ $order->customer->email }}
                        </address>
                    </div>
                </div>
            </div> <!-- end col -->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Billing Information</h4>
                        <ul class="list-unstyled mb-0">
                            <li>
                                <p class="mb-2"><span class="fw-bold me-2">Payment Type:</span> Bank Transfer</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> <!-- end col -->

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Extra Prices</h4>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Extra Price</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->extraPrices as $extraPrice)
                                    <tr>
                                        <td>{{ $extraPrice->extraPrice->extraPrice->name }}</td>
                                        <td>PKR {{ number_format($extraPrice->value, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div> <!-- end col -->

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Adjustable Values</h4>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Attribute</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->adjustables as $adjustable)
                                        <?php

                                        $productAttribute = ProductAssignedAttributes::find($adjustable->adjustable_id);
?>
                                    <tr>
                                        <td>{{ $productAttribute->productAttribute->name }}</td>
                                        <td>{{ $adjustable->adjustable_value }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div> <!-- end col -->

        </div>
        <!-- end row -->

    </div> <!-- container -->
</div> <!-- content -->
@endsection