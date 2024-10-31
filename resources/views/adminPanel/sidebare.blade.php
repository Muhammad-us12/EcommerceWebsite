<li class="side-nav-item">
    <a href="{{ URL::to('/dashboard') }}" class="side-nav-link">
        <i class="uil-home-alt"></i>
        <span class="badge bg-success float-end">4</span>
        <span> Dashboards </span>
    </a>
    
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

                    