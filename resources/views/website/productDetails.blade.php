
@extends('website/includes/master') 
 @section('content')        
 
     
 
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Product Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->
    
    
    <!-- content-wraper start -->
    <div class="content-wraper">
        <div class="container">
            <div class="row single-product-area">
                <div class="col-md-12">
                @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                </div>
                <div class="col-lg-6 col-md-6">
                   <!-- Product Details Left -->
                    <div class="product-details-left">
                        <div class="product-details-images-2 slider-lg-image-2">
                        <div class="lg-image">
                                <a href="{{ $product->getFirstMediaUrl('image') }}" class="img-poppu"><img src="{{ $product->getFirstMediaUrl('image') }}" alt="product image"></a>
                            </div>
                        @isset($productGallies)
                        @foreach($productGallies as $productGalley)
                            <div class="lg-image">
                                <a href="{{ $productGalley->getUrl() }}" class="img-poppu"><img src="{{ $productGalley->getUrl() }}" alt="product image"></a>
                            </div>
                            @endforeach
                            @endisset
                        </div>
                        <div class="product-details-thumbs-2 slider-thumbs-2">		
                        @isset($productGallies)
                        @foreach($productGallies as $productGalley)								
                            <div class="sm-image"><img src="{{ $productGalley->getUrl() }}" alt="product image thumb"></div>
                            @endforeach
                            @endisset
                           
                        </div>
                    </div>
                    <!--// Product Details Left -->
                </div>

                <div class="col-lg-6 col-md-6">
                    <form action="{{ URL::to('add-to-cart/'.$product->id.'') }}" method="post">
                        @csrf
                    <div class="product-details-view-content">
                        <div class="product-info">
                            <h2>{{ $product->name }}</h2>
                            <div class="price-box">
                                <!-- <span class="old-price">$70.00</span> -->
                                <span class="new-price">{{ $product->price }}.00 PKR</span>
                                <span class="discount discount-percentage">Save 5%</span>
                            </div>
                            <p>{{ Str::limit($product->description,200) }}</p>
                            <div class="product-variants">
                                <div class="produt-variants-size">
                                    <label>{{ $product->category->name }}</label>
                                </div>
                                <div class="produt-variants-color">
                                    <label>{{ $product->subCategory->name }}</label>
                                </div>
                                <div class="produt-variants-color ml-3" style="margin-left: 2rem;">
                                    <label>Brand: {{ $product->brand->name }}</label>
                                </div>
                            </div>
                           
                            <div class="product-availability">
                                <h4>Select Your Dates</h4>
                                <input id="dateRangePicker" name="bookingDates" required type="text" placeholder="Select date range">
                                <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                                <script>
                                    // Initialize Flatpickr as a range picker

                                    var rentForDays = {{ $product->rent_for_days }};
                                    rentForDays = parseInt(rentForDays);
                                    flatpickr("#dateRangePicker", {
                                        mode: "range", // Enable range selection
                                        dateFormat: "Y-m-d", // Format for selected dates
                                        minDate: "{{ $currentDate }}", // Minimum selectable date
                                        maxDate: "{{ $dateAfter12Months }}", // Maximum selectable date
                                        disable: [
                                            "2024-01-03", // Disable specific dates
                                            "2024-01-05"
                                        ],
                                        onChange: function(selectedDates, dateStr, instance) {
                                            if (selectedDates.length === 1) {
                                                // If only the start date is selected, automatically select the next 3 days
                                                const startDate = selectedDates[0];
                                                const endDate = new Date(startDate);
                                                endDate.setDate(startDate.getDate() + rentForDays); // Add 2 days to make it a 3-day range
                                                instance.setDate([startDate, endDate], true);
                                            } else if (selectedDates.length > rentForDays) {
                                                // If more than 3 days are selected, reset to the first 3 days
                                                const startDate = selectedDates[0];
                                                const endDate = new Date(startDate);
                                                endDate.setDate(startDate.getDate() + 2); // Add 2 days to make it a 3-day range
                                                instance.setDate([startDate, endDate], true);
                                            }
                                        },
        });
                                </script>
                              <i class="fa fa-check"></i> In stock
                            </div>
                            <div>
                            @isset($product->productExtraPrices)
                                    <h4 class="mt-4">You Can Add Additional Services</h4>
                                    @foreach($product->productExtraPrices as $productExtraPrice)
                                            <div class="form-check mr-2">
                                                <input class="form-check-input" type="checkbox" name="selectedExtraPrices[]" value="{{ $productExtraPrice->id }}" id="extraPrice{{ $productExtraPrice->id }}">
                                                <label class="form-check-label" for="extraPrice{{ $productExtraPrice->id }}">
                                                {{ $productExtraPrice->extraPrice->name }} Price {{ $productExtraPrice->value }} PKR 
                                                </label>
                                            </div>
                                    @endforeach
                                @endisset
                            </div>
                            <div>
                                <div class="pro_feature">
                                    <h2 class="title_3">Size Details</h2>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                @isset($product->productAssignedAttributes)
                                                    @foreach($product->productAssignedAttributes as $productAttribute)
                                                        <th scope="col">{{ $productAttribute->productAttribute->name }}</th>
                                                    @endforeach
                                                @endisset
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            @php 
                                                $measurementAdjustable = false;
                                            @endphp
                                                @isset($product->productAssignedAttributes)
                                                    @foreach($product->productAssignedAttributes as $productAttribute)
                                                        @php 
                                                            if($productAttribute->adjustable){
                                                                $measurementAdjustable = true;
                                                            }
                                                        @endphp
                                                        <th scope="col">{{ $productAttribute->value }}</th>
                                                    @endforeach
                                                @endisset
                                            
                                            </tr>
                                        </tbody>
                                        </table>
                                        @if($measurementAdjustable)
                                        <div class="div">
                                            <div class="form-check">
                                                <input class="form-check-input" onchange="checkSizeAdjustable()" type="radio" value="true" name="goodFit" id="flexRadioDefault1" checked>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Good Fit
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" onchange="checkSizeAdjustable()" type="radio" value="false" name="goodFit" id="flexRadioDefault2">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    Not Good Fit
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div id="notGoodFitModal" class="modal" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Not Good Fit Selected</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <h2 class="title_3">Adjust it</h2>
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                <th>Name</th>
                                                                <th>Value</th>
                                                                <th>Adjustable</th>
                                                                
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            @isset($product->productAssignedAttributes)
                                                                @foreach($product->productAssignedAttributes as $productAttribute)
                                                                    @if($productAttribute->adjustable)
                                                                    <tr>
                                                                        <td>{{ $productAttribute->productAttribute->name }}</td>
                                                                        <td>{{ $productAttribute->value }}</td>
                                                                        <td>
                                                                        <input type="text" name="adjustableIds[]" hidden value="{{ $productAttribute->id }}">
                                                                            <div class="input-group mb-3">
                                                                                <span class="input-group-text">{{ $productAttribute->min_value }}</span>
                                                                                    
                                                                                    <input type="number" name="adjustableValues[]" step="any" class="form-control" value="{{ $productAttribute->value }}" aria-label="Amount (to the nearest dollar)">
                                                                                <span class="input-group-text">{{ $productAttribute->max_value }}</span>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    @endif
                                                                @endforeach
                                                            @endisset

                                                            </tbody>
                                                            </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <script>
                                            function checkSizeAdjustable() {
                                                const goodFitValue = document.querySelector('input[name="goodFit"]:checked').value;
                                                
                                                if (goodFitValue === "false") {
                                                    // Open the modal
                                                    const modal = new bootstrap.Modal(document.getElementById('notGoodFitModal'));
                                                    modal.show();
                                                }
                                            }

                                        </script>

                                        @endif

                                </div>
                            </div>
                            <div class="single-add-to-cart cart-quantity">
                                  
                                    <button class="add-to-cart" type="submit">Add to cart</button>
                            </div>

                            <div class="product-social-sharing">
                                <label>Share</label>
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    </form>
                </div> 
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-details-tab mt--60">
                        <ul role="tablist" class="mb--50 nav">
                            <li class="active" role="presentation">
                                <a data-bs-toggle="tab" role="tab" href="#description" class="active">Description</a>
                            </li>
                            <li role="presentation">
                                <a data-bs-toggle="tab" role="tab" href="#reviews">Reviews</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12">
                    <div class="product_details_tab_content tab-content">
                        <!-- Start Single Content -->
                        <div class="product_tab_content tab-pane active" id="description" role="tabpanel">
                            <div class="product_description_wrap">
                                <div class="product_desc mb--30">
                                    <h2 class="title_3">Details</h2>
                                    <p>
                                        {{ $product->description }}
                                    </p>
                                </div>
                               
                            </div>
                        </div>
                        <!-- End Single Content -->
                        <!-- Start Single Content -->
                    
                        <!-- End Single Content -->
                        <!-- Start Single Content -->
                        <div class="product_tab_content tab-pane" id="reviews" role="tabpanel">
                            <div class="review_address_inner">
                                <!-- Start Single Review -->
                                <div class="pro_review">
                                    <div class="review_thumb">
                                        <img alt="review images" src="assets/images/review/1.jpg">
                                    </div>
                                    <div class="review_details">
                                        <div class="review_info">
                                            <h4><a href="#">Gerald Barnes</a></h4>
                                            <ul class="product-rating d-flex">
                                                <li><span class="fa fa-star"></span></li>
                                                <li><span class="fa fa-star"></span></li>
                                                <li><span class="fa fa-star"></span></li>
                                                <li><span class="fa fa-star"></span></li>
                                                <li><span class="fa fa-star"></span></li>
                                            </ul>
                                            <div class="rating_send">
                                                <a href="#"><i class="fa fa-reply"></i></a>
                                            </div>
                                        </div>
                                        <div class="review_date">
                                            <span>27 Jun, 2023 at 3:30pm</span>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas elese ifend. Phasellus a felis at estei to bibendum feugiat ut eget eni Praesent et messages in con sectetur posuere dolor non.</p>
                                    </div>
                                </div>
                                <!-- End Single Review -->
                                <!-- Start Single Review -->
                                <div class="pro_review ans">
                                    <div class="review_thumb">
                                        <img alt="review images" src="assets/images/review/2.jpg">
                                    </div>
                                    <div class="review_details">
                                        <div class="review_info">
                                            <h4><a href="#">Gerald Barnes</a></h4>
                                            <ul class="product-rating d-flex">
                                                <li><span class="fa fa-star"></span></li>
                                                <li><span class="fa fa-star"></span></li>
                                                <li><span class="fa fa-star"></span></li>
                                                <li><span class="fa fa-star"></span></li>
                                                <li><span class="fa fa-star"></span></li>
                                            </ul>
                                            <div class="rating_send">
                                                <a href="#"><i class="fa fa-reply"></i></a>
                                            </div>
                                        </div>
                                        <div class="review_date">
                                            <span>27 Jun, 2023 at 4:32pm</span>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas elese ifend. Phasellus a felis at estei to bibendum feugiat ut eget eni Praesent et messages in con sectetur posuere dolor non.</p>
                                    </div>
                                </div>
                                <!-- End Single Review -->
                            </div>
                            <!-- Start RAting Area -->
                            <div class="rating_wrap">
                                <h2 class="rating-title">Write  A review</h2>
                                <h4 class="rating-title-2">Your Rating</h4>
                                <div class="rating_list">
                                    <ul class="product-rating d-flex">
                                        <li><span class="fa fa-star"></span></li>
                                        <li><span class="fa fa-star"></span></li>
                                        <li><span class="fa fa-star"></span></li>
                                        <li><span class="fa fa-star"></span></li>
                                        <li><span class="fa fa-star"></span></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End RAting Area -->
                            <div class="comments-area comments-reply-area">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form action="#" class="comment-form-area">
                                            <div class="comment-input">
                                                <p class="comment-form-author">
                                                    <label>Name <span class="required">*</span></label> 
                                                    <input type="text" required="required" name="Name">
                                                </p>
                                                <p class="comment-form-email">
                                                    <label>Email <span class="required">*</span></label> 
                                                    <input type="text" required="required" name="email">
                                                </p>
                                            </div>
                                            <p class="comment-form-comment">
                                                <label>Comment</label> 
                                                <textarea class="comment-notes" required="required"></textarea>
                                            </p>
                                            <div class="comment-form-submit">
                                                <input type="submit" value="Post Comment" class="comment-submit">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>                             
                        </div>
                        <!-- End Single Content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wraper end -->
    
    
    <!-- Product Area Start -->
    <div class="product-area section-pt">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- section-title start -->
                    <div class="section-title section-bg-2">
                        <h2>Other Products</h2>
                        <p>Most Trendy 2023 Clother</p>
                    </div>
                    <!-- section-title end -->
                </div>
            </div>
            <!-- product-wrapper start -->
            <div class="product-wrapper">
                <div class="row product-slider">
                    <div class="col-12">
                        <!-- single-product-wrap start -->
                        <div class="single-product-wrap">
                            <div class="product-image">
                                <a href="product-details.html"><img src="assets/images/product/9.jpg" alt=""></a>
                                <span class="label-product label-new">new</span>
                                <span class="label-product label-sale">-9%</span>
                                <div class="quick_view">
                                    <a href="#" title="quick view" class="quick-view-btn" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="product-details.html">Fusce nec facilisi</a></h3>
                                <div class="price-box">
                                    <span class="new-price">$53.27</span>
                                    <span class="old-price">$58.49</span>
                                </div>
                                <div class="product-action">
                                    <button class="add-to-cart" title="Add to cart"><i class="fa fa-plus"></i> Add to cart</button>
                                    <div class="star_content">
                                        <ul class="d-flex">
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star-o" href="#"><i class="fa fa-star-o"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single-product-wrap end -->
                    </div>
                    <div class="col-12">
                        <!-- single-product-wrap start -->
                        <div class="single-product-wrap">
                            <div class="product-image">
                                <a href="product-details.html"><img src="assets/images/product/4.jpg" alt=""></a>
                                <span class="label-product label-new">new</span>
                                <span class="label-product label-sale">-7%</span>
                                <div class="quick_view">
                                    <a href="#" title="quick view" class="quick-view-btn" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="product-details.html">Sprite Yoga Straps1</a></h3>
                                <div class="price-box">
                                    <span class="new-price">$57.27</span>
                                    <span class="old-price">$52.49</span>
                                </div>
                                <div class="product-action">
                                    <button class="add-to-cart" title="Add to cart"><i class="fa fa-plus"></i> Add to cart</button>
                                    <div class="star_content">
                                        <ul class="d-flex">
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star-o" href="#"><i class="fa fa-star-o"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single-product-wrap end -->
                    </div>
                    <div class="col-12">
                        <!-- single-product-wrap start -->
                        <div class="single-product-wrap">
                            <div class="product-image">
                                <a href="product-details.html"><img src="assets/images/product/5.jpg" alt=""></a>
                                <span class="label-product label-new">new</span>
                                <span class="label-product label-sale">-7%</span>
                                <div class="quick_view">
                                    <a href="#" title="quick view" class="quick-view-btn" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="product-details.html">Wrinted Summer Dress</a></h3>
                                <div class="price-box">
                                    <span class="new-price">$51.27</span>
                                    <span class="old-price">$54.49</span>
                                </div>
                                <div class="product-action">
                                    <button class="add-to-cart" title="Add to cart"><i class="fa fa-plus"></i> Add to cart</button>
                                    <div class="star_content">
                                        <ul class="d-flex">
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star-o" href="#"><i class="fa fa-star-o"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single-product-wrap end -->
                    </div>
                    <div class="col-12">
                        <!-- single-product-wrap start -->
                        <div class="single-product-wrap">
                            <div class="product-image">
                                <a href="product-details.html"><img src="assets/images/product/6.jpg" alt=""></a>
                                <span class="label-product label-new">new</span>
                                <span class="label-product label-sale">-4%</span>
                                <div class="quick_view">
                                    <a href="#" title="quick view" class="quick-view-btn" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="product-details.html">Printed Dress</a></h3>
                                <div class="price-box">
                                    <span class="new-price">$91.27</span>
                                    <span class="old-price">$84.49</span>
                                </div>
                                <div class="product-action">
                                    <button class="add-to-cart" title="Add to cart"><i class="fa fa-plus"></i> Add to cart</button>
                                    <div class="star_content">
                                        <ul class="d-flex">
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star-o" href="#"><i class="fa fa-star-o"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single-product-wrap end -->
                    </div>
                    <div class="col-12">
                        <!-- single-product-wrap start -->
                        <div class="single-product-wrap">
                            <div class="product-image">
                                <a href="product-details.html"><img src="assets/images/product/7.jpg" alt=""></a>
                                <span class="label-product label-new">new</span>
                                <span class="label-product label-sale">-7%</span>
                                <div class="quick_view">
                                    <a href="#" title="quick view" class="quick-view-btn" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="product-details.html">Printed Summer Dress</a></h3>
                                <div class="price-box">
                                    <span class="new-price">$51.27</span>
                                    <span class="old-price">$54.49</span>
                                </div>
                                <div class="product-action">
                                    <button class="add-to-cart" title="Add to cart"><i class="fa fa-plus"></i> Add to cart</button>
                                    <div class="star_content">
                                        <ul class="d-flex">
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star-o" href="#"><i class="fa fa-star-o"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single-product-wrap end -->
                    </div>
                </div>
            </div>
            <!-- product-wrapper end -->
        </div>
    </div>
    <!-- Product Area End -->
        @endsection
