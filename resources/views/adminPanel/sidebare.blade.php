<li class="side-nav-item">
    <a href="{{ URL::to('/dashboard') }}" class="side-nav-link">
        <i class="uil-home-alt"></i>
        <span class="badge bg-success float-end">4</span>
        <span> Dashboards </span>
    </a>
    
</li>

<li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#sliderNav" aria-expanded="false" aria-controls="sliderNav" class="side-nav-link">
        <i class="uil-home-alt"></i>
        <span class="badge bg-success float-end">4</span>
        <span> Sliders </span>
    </a>
    <div class="collapse" id="sliderNav">
        <ul class="side-nav-second-level">
            <li>
                <a href="{{ URL::to('admin/sliders') }}">Sliders List</a>
            </li>
        </ul>
    </div>
</li>

<li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#category" aria-expanded="false" aria-controls="category" class="side-nav-link">
        <i class="uil-home-alt"></i>
        <!-- <span class="badge bg-success float-end">4</span> -->
        <span> Categories </span>
    </a>
    <div class="collapse" id="category">
        <ul class="side-nav-second-level">
            <li>
                <a href="{{ URL::to('admin/categories') }}">Categoriess</a>
            </li>
            <li>
                <a href="{{ URL::to('admin/categories/sub-categories') }}">Sub Categoriess</a>
            </li>
        </ul>
    </div>
</li>

<li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#brands" aria-expanded="false" aria-controls="brands" class="side-nav-link">
        <i class="uil-home-alt"></i>
        <!-- <span class="badge bg-success float-end">4</span> -->
        <span> Brands </span>
    </a>
    <div class="collapse" id="brands">
        <ul class="side-nav-second-level">
            <li>
                <a href="{{ URL::to('admin/brand') }}">Brands</a>
            </li>
        </ul>
    </div>
</li>
<li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#locations" aria-expanded="false" aria-controls="locations" class="side-nav-link">
        <i class="uil-home-alt"></i>
        <!-- <span class="badge bg-success float-end">4</span> -->
        <span> Locations </span>
    </a>
    <div class="collapse" id="locations">
        <ul class="side-nav-second-level">
            <li>
                <a href="{{ URL::to('admin/location') }}">Locations</a>
            </li>
        </ul>
    </div>
</li>

<li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#ProductAttribute" aria-expanded="false" aria-controls="ProductAttribute" class="side-nav-link">
        <i class="uil-home-alt"></i>
        <!-- <span class="badge bg-success float-end">4</span> -->
        <span> Product Attribute </span>
    </a>
    <div class="collapse" id="ProductAttribute">
        <ul class="side-nav-second-level">
            <li>
                <a href="{{ URL::to('admin/product-attribute') }}">Product Attribute</a>
            </li>
        </ul>
    </div>
</li>

<li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#extraPrices" aria-expanded="false" aria-controls="extraPrices" class="side-nav-link">
        <i class="uil-home-alt"></i>
        <!-- <span class="badge bg-success float-end">4</span> -->
        <span> Extra Prices </span>
    </a>
    <div class="collapse" id="extraPrices">
        <ul class="side-nav-second-level">
            <li>
                <a href="{{ URL::to('admin/extra-price') }}">Extra Prices</a>
            </li>
        </ul>
    </div>
</li>
          
<li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#Product" aria-expanded="false" aria-controls="Product" class="side-nav-link">
        <i class="uil-home-alt"></i>
        <!-- <span class="badge bg-success float-end">4</span> -->
        <span> Product</span>
    </a>
    <div class="collapse" id="Product">
        <ul class="side-nav-second-level">
            <li>
                <a href="{{ URL::to('admin/product') }}">Product</a>
            </li>
        </ul>
    </div>
</li>

<li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#Orders" aria-expanded="false" aria-controls="Orders" class="side-nav-link">
        <i class="uil-home-alt"></i>
        <!-- <span class="badge bg-success float-end">4</span> -->
        <span> Orders</span>
    </a>
    <div class="collapse" id="Orders">
        <ul class="side-nav-second-level">
            <li>
                <a href="{{ URL::to('admin/orders') }}">Orders</a>
            </li>
        </ul>
    </div>
</li>

<li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#paymentRequest" aria-expanded="false" aria-controls="paymentRequest" class="side-nav-link">
        <i class="uil-home-alt"></i>
        <!-- <span class="badge bg-success float-end">4</span> -->
        <span> Payment Request</span>
    </a>
    <div class="collapse" id="paymentRequest">
        <ul class="side-nav-second-level">
            <li>
                <a href="{{ URL::to('admin/customer-payment-requests') }}">Payment Request</a>
            </li>
        </ul>
    </div>
</li>


<li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#Vendor" aria-expanded="false" aria-controls="Vendor" class="side-nav-link">
        <i class="uil-home-alt"></i>
        <!-- <span class="badge bg-success float-end">4</span> -->
        <span> Vendor</span>
    </a>
    <div class="collapse" id="Vendor">
        <ul class="side-nav-second-level">
            <li>
                <a href="{{ URL::to('admin/vendor') }}">Vendor</a>
            </li>
            <li>
                <a href="{{ URL::to('admin/vendorSalePercentages') }}">Vendor Percentage</a>
            </li>
        </ul>
    </div>
</li>

<li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#Customer" aria-expanded="false" aria-controls="Customer" class="side-nav-link">
        <i class="uil-home-alt"></i>
        <!-- <span class="badge bg-success float-end">4</span> -->
        <span> Customer</span>
    </a>
    <div class="collapse" id="Customer">
        <ul class="side-nav-second-level">
            <li>
                <a href="{{ URL::to('admin/customer') }}">Customer</a>
            </li>
        </ul>
    </div>
</li>


                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#party" aria-expanded="false" aria-controls="party" class="side-nav-link">
                            <i class="uil-home-alt"></i>
                            <!-- <span class="badge bg-success float-end">4</span> -->
                            <span> Party </span>
                        </a>
                        <div class="collapse" id="party">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="{{ URL::to('get-parties-list') }}">Party list</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#account" aria-expanded="false" aria-controls="agentNav" class="side-nav-link">
                            <i class="uil-home-alt"></i>
                            <!-- <span class="badge bg-success float-end">4</span> -->
                            <span> Accounts </span>
                        </a>
                        <div class="collapse" id="account">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="{{ URL::to('add-account') }}">Accounts list & Cash Deposit</a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('add-make-payment') }}">Payments & Receiving</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#expenseNav" aria-expanded="false" aria-controls="expenseNav" class="side-nav-link">
                            <i class="uil-home-alt"></i>
                            <span class="badge bg-success float-end">4</span>
                            <span> Expense </span>
                        </a>
                        <div class="collapse" id="expenseNav">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="{{ URL::to('expense-list') }}">Expense List</a>
                                </li>

                                <li>
                                    <a href="{{ URL::to('expense-categories') }}">Categories</a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('expense-sub-categories') }}">Sub Categories</a>
                                </li>
                            </ul>
                        </div>
                    </li>
