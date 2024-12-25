<li class="side-nav-item">
    <a href="{{ URL::to('/dashboard') }}" class="side-nav-link">
        <i class="uil-home-alt"></i>
        <span class="badge bg-success float-end">4</span>
        <span> Dashboards </span>
    </a>
    
</li>

<li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#paymentRequestNav" aria-expanded="false" aria-controls="paymentRequestNav" class="side-nav-link">
        <i class="uil-home-alt"></i>
        <span class="badge bg-success float-end">4</span>
        <span> Payment Request </span>
    </a>
    <div class="collapse" id="paymentRequestNav">
        <ul class="side-nav-second-level">
            <li>
                <a href="{{ URL::to('customer/payment_request') }}">Payment Request</a>
            </li>
            
        </ul>
    </div>
</li>
      

<li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#ordersNav" aria-expanded="false" aria-controls="ordersNav" class="side-nav-link">
        <i class="uil-home-alt"></i>
        <span class="badge bg-success float-end">4</span>
        <span> My Orders </span>
    </a>
    <div class="collapse" id="ordersNav">
        <ul class="side-nav-second-level">
            <li>
                <a href="{{ URL::to('customer/order-list') }}">My Orders</a>
            </li>
            
        </ul>
    </div>
</li>
      