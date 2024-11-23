<li class="side-nav-item">
    <a href="{{ URL::to('/dashboard') }}" class="side-nav-link">
        <i class="uil-home-alt"></i>
        <span class="badge bg-success float-end">4</span>
        <span> Dashboards </span>
    </a>
    
</li>

<li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#blogsNav" aria-expanded="false" aria-controls="blogsNav" class="side-nav-link">
        <i class="uil-home-alt"></i>
        <span class="badge bg-success float-end">4</span>
        <span> On Boarding </span>
    </a>
    <div class="collapse" id="blogsNav">
        <ul class="side-nav-second-level">
            <li>
                <a href="{{ URL::to('vendor/on-boarding') }}">On Boarding</a>
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
                <a href="{{ URL::to('vendor/product') }}">Product</a>
            </li>
        </ul>
    </div>
</li>
                    