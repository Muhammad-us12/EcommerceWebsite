
@extends('website/includes/master') 
 @section('content')        
   <!-- breadcrumb-area start -->
   <div class="breadcrumb-area bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Checkout Page</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->
    
    
    <!-- content-wraper start -->
    <div class="content-wraper">
        <div class="container">
            
            <!-- checkout-details-wrapper start -->
            <div class="checkout-details-wrapper">
                <div class="row">
                <div class="col-lg-6 col-md-6">
    <!-- billing-details-wrap start -->
    <div class="billing-details-wrap">
        <form action="#">
            <h3 class="shoping-checkboxt-title">Billing Details</h3>
            <div class="row">
                <div class="col-lg-6">
                    <p class="single-form-row">
                        <label>First name <span class="required">*</span></label>
                        <input type="text" name="first_name" required>
                    </p>
                </div>
                <div class="col-lg-6">
                    <p class="single-form-row">
                        <label>Last name <span class="required">*</span></label>
                        <input type="text" name="last_name" required>
                    </p>
                </div>
                <div class="col-lg-12">
                    <p class="single-form-row">
                        <label>Company name</label>
                        <input type="text" name="company_name">
                    </p>
                </div>
                <div class="col-lg-12">
                    <div class="single-form-row">
                        <label>Country <span class="required">*</span></label>
                        <select name="country" class="form-control" required>
                            <option>Select Country...</option>
                            @isset($locations)
                                @foreach($locations as $location)
                                <option value="{{ $location['name'] }}">{{ $location['name'] }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                </div>
                <div class="col-lg-12">
                    <p class="single-form-row">
                        <label>Street address <span class="required">*</span></label>
                        <input type="text" placeholder="House number and street name" name="street_address" required>
                    </p>
                </div>
                <div class="col-lg-12">
                    <p class="single-form-row">
                        <input type="text" placeholder="Apartment, suite, unit etc. (optional)" name="apartment">
                    </p>
                </div>
                <div class="col-lg-12">
                    <p class="single-form-row">
                        <label>Phone <span class="required">*</span></label>
                        <input type="text" name="phone" required>
                    </p>
                </div>
                <div class="col-lg-12">
                    <p class="single-form-row">
                        <label>Email address <span class="required">*</span></label>
                        <input type="email" name="email" required>
                    </p>
                </div>
                <!-- Account creation (Mandatory) -->
                <div class="col-lg-12">
                    <div class="checkout-box-wrap">
                        <h4>Create an Account</h4>
                        <p class="single-form-row">
                            <label>Password <span class="required">*</span></label>
                            <input type="password" class="input-text" name="password" required>
                        </p>
                        <p class="single-form-row">
                            <label>Confirm Password <span class="required">*</span></label>
                            <input type="password" class="input-text" name="confirm_password" required>
                        </p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <p class="single-form-row m-0">
                        <label>Order notes</label>
                        <textarea placeholder="Notes about your order, e.g. special notes for delivery." name="order_notes" class="checkout-mess" rows="2" cols="5"></textarea>
                    </p>
                </div>
            </div>
        </form>
    </div>
    <!-- billing-details-wrap end -->
</div>


                    <div class="col-lg-6 col-md-6">
                        <!-- your-order-wrapper start -->
                        <div class="your-order-wrapper">
                            <h3 class="shoping-checkboxt-title">Your Order</h3>
                            <!-- your-order-wrap start-->
                            <div class="your-order-wrap">
                                <!-- your-order-table start -->
                                <div class="your-order-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-name">Product</th>
                                                <th class="product-total">Total</th>
                                            </tr>							
                                        </thead>
                                        <tbody>
                                            <tr class="cart_item">
                                                <td class="product-name">
                                                    <img src="{{ $cart['product']->getFirstMediaUrl('image') }}" alt="">
                                                </td>
                                                <td class="product-name">
                                                    <h4>{{ $cart['product']->name }}</h4>
                                                    
                                                    <br>
                                                    <b>{{ $cart['price'] }}.00 PKR</b>
                                                </td>
                                               
                                            </tr>
                                            <tr class="cart_item">
                                                <th>Rent Date</th>  
                                                <td><span class="amount">{{ $cart['startDate'] }} to {{ $cart['endDate'] }}</span></td>
                                            </tr>
                                            <tr class="cart_item">
                                                <th>Sub total For {{ $cart['totalDays'] }} Days</th>  
                                                <td><span class="amount">{{ $cart['priceForTotalDays'] }}.00 PKR</span></td>
                                            </tr>
                                            <tr class="cart_item">
                                                <th>Security Deposit</th>  
                                                <td><span class="amount">{{ $cart['securityDeposit'] }}.00 PKR</span></td>
                                            </tr>
                                            <tr class="cart_item">
                                                <th>Extra Service</th>  
                                                <td><span class="amount">Price</span></td>
                                            </tr>

                                            @isset($cart['extraService'])
                                            @foreach($cart['extraService'] as $extraService)
                                            <tr class="cart_item">
                                                <th>{{ $extraService->extraPrice->name }}</th>  
                                                <td><span class="amount">{{ $extraService->value }}.00 PKR</span></td>
                                            </tr>
                                            @endforeach
                                            @endisset
                                        </tbody>
                                        <tfoot>
                                            <tr class="cart-subtotal">
                                                <th>Cart Subtotal</th>
                                                <td><span class="amount">{{ $cart['subTotalPrice'] }}.00 PKR</span></td>
                                            </tr>
                                          
                                            <tr class="order-total">
                                                <th>Order Total</th>
                                                <td><strong><span class="amount">{{ $cart['totalPrice'] }}.00 PKR</span></strong>
                                                </td>
                                            </tr>								
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- your-order-table end -->
                                
                                <!-- your-order-wrap end -->
                                <div class="payment-method">
                                    <div class="payment-accordion">
                                        <!-- ACCORDION START -->
                                        <h3>Direct Bank Transfer</h3>
                                        <div class="payment-content">
                                            <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                        <!-- ACCORDION END -->	
                                        <!-- ACCORDION START -->
                                        <h3>Cheque Payment</h3>
                                        <div class="payment-content">
                                            <p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                        </div>
                                        <!-- ACCORDION END -->	
                                        <!-- ACCORDION START -->
                                        <h3>PayPal <img src="assets/images/icon/4.png" alt="" /></h3>
                                        <div class="payment-content">
                                            <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                        </div>
                                        <!-- ACCORDION END -->									
                                    </div>
                                    <div class="order-button-payment">
                                        <input type="submit" value="Place order" />
                                    </div>
                                </div>
                                <!-- your-order-wrapper start -->
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- checkout-details-wrapper end -->
        </div>
    </div>
    <!-- content-wraper end -->
             @endsection
