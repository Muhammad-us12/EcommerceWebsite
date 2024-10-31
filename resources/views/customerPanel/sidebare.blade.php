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
        <span> Blogs </span>
    </a>
    <div class="collapse" id="blogsNav">
        <ul class="side-nav-second-level">
            <li>
                <a href="{{ URL::to('blogs-list') }}">Blogs List</a>
            </li>
            <li>
                <a href="{{ URL::to('blogs-add') }}">Add Blogs</a>
            </li>
            <li>
                <a href="{{ URL::to('blogs-categories') }}">Blog Categories</a>
            </li>
            
        </ul>
    </div>
</li>
                    