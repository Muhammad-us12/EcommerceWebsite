@extends('website/includes/master')

@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Order Confirmation</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <!-- content-wraper start -->
    <div class="content-wraper">
        <div class="container">
            <!-- order-confirmation-wrapper start -->
            <div class="order-confirmation-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="shoping-checkboxt-title">Order Confirmation</h3>
                        <p>Thank you for your order. Here are your order details:</p>
                        <div class="order-details">
                            <h4>Customer Details</h4>
                            <p><strong>Name:</strong> {{ $order->customer_name }}</p>
                            <p><strong>Email:</strong> {{ $order->email }}</p>
                            <p><strong>Phone:</strong> {{ $order->phone }}</p>

                            <h4>Order Details</h4>
                            <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
                            <p><strong>Order Notes:</strong> {{ $order->order_notes }}</p>
                            <p><strong>Sub Total:</strong> ${{ number_format($order->sub_total, 2) }}</p>
                            <p><strong>Extra Service Total:</strong> ${{ number_format($order->extra_service_total, 2) }}</p>
                            <p><strong>Discount:</strong> ${{ number_format($order->discount, 2) }}</p>
                            <p><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>
                            <p><strong>Status:</strong> {{ $order->status }}</p>
                            <p><strong>Start Date:</strong> {{ $order->start_date }}</p>
                            <p><strong>End Date:</strong> {{ $order->end_date }}</p>
                            <p><strong>Total Days:</strong> {{ $order->total_days }}</p>

                            <h4>Order Line Items</h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Price for Total Days</th>
                                        <th>Security Deposit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->lineItems as $item)
                                        <tr>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>PKR {{ number_format($item->price, 2) }}</td>
                                            <td>PKR{{ number_format($item->price_for_total_days, 2) }}</td>
                                            <td>PKR{{ number_format($item->security_deposit, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <h4>Extra Prices</h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Extra Price</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->extraPrices as $extraPrice)
                                        <tr>
                                            <td>{{ $extraPrice->extraPrice->name }}</td>
                                            <td>PKR{{ number_format($extraPrice->value, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <h4>Adjustable Values</h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Adjustable ID</th>
                                        <th>Adjustable Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->adjustables as $adjustable)
                                        <tr>
                                            <td>{{ $adjustable->adjustable_id }}</td>
                                            <td>{{ number_format($adjustable->adjustable_value, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- order-confirmation-wrapper end -->
        </div>
    </div>
    <!-- content-wraper end -->
@endsection