
@extends('website/includes/master') 
 @section('content')        
 
         <!-- Hero Slider start -->
    <div class="hero-slider-box">
        <div class="hero-slider hero-slider-eight">
        @isset($sliders)
		@foreach($sliders as $slider)
            <div class="single-slide" style="background-image: url({{ $slider->getFirstMediaUrl('images') }})">
                <!-- Hero Content One Start -->
                <div class="hero-content-one container">
                    <div class="row">
                        <div class="col"> 
                            <div class="slider-text-info">
                                <h1>{{ $slider->title1 }}</h1>
                                <h1>{{ $slider->title2 }}</h1>
                                <p>{{ $slider->shortParagraph }}</p>
                                <a href="shop.html" class="btn slider-btn uppercase"><span><i class="fa fa-plus"></i> Shop Now</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Hero Content One End -->
            </div>
            @endforeach
	@endisset
            
        </div>
    </div>
    <!-- Hero Slider end -->

    <!-- Banner area start -->
    <div class="banner-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 order-2 order-lg-1">
                    <!-- single-banner start -->
                    <div class="single-banner mt--30">
                        <a href="shop.html"><img src="{{ asset('website/assets/images/banner/banner_02.png') }}" alt=""></a>
                    </div>
                    <!-- single-banner end -->
                </div>
                <div class="col-lg-6 col-md-12 order-1 order-lg-2">
                    <!-- single-banner start -->
                    <div class="single-banner mt--30">
                        <a href="shop.html"><img src="{{ asset('website/assets/images/banner/banner_02.png') }}" alt=""></a>
                    </div>
                    <!-- single-banner end -->
                </div>
                <div class="col-lg-3 col-md-6 order-3 order-lg-3">
                    <!-- single-banner start -->
                    <div class="single-banner mt--30">
                        <a href="shop.html"><img src="{{ asset('website/assets/images/banner/banner_02.png') }}" alt=""></a>
                    </div>
                    <!-- single-banner end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Banner area end -->

    <!-- Product Area Start -->
    <div class="product-area section-pt section-pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- section-title start -->
                    <div class="section-title text-center">
                        <h2>Popular Products</h2>
                        <p>Most Trendy 2023 Clother</p>
                    </div>
                    <!-- section-title end -->
                </div>
                <div class="col-12">
                    <div class="tabs-categorys-list-four">
                        <ul class="nav justify-content-center" role="tablist">
                            @isset($categoriesWithProducts)
                            @foreach($categoriesWithProducts as $categoriesWithProduct)
                            @php
                            if ($loop->iteration == 4) {
                                break;
                            }
                            @endphp
                           <li class="active"><a class="@if($loop->iteration == 1) active @endif" href="#cat{{ $categoriesWithProduct->id }}" role="tab" data-bs-toggle="tab">{{ $categoriesWithProduct->name }}</a></li>
                           @endforeach
                           @endisset
                       </ul>
                    </div>
                </div>
            </div>
            <!-- product-wrapper start -->
            <div class="product-wrapper-tab-panel">
                <!-- tab-contnt start -->
                <div class="tab-content">
                @isset($categoriesWithProducts)
                    @foreach($categoriesWithProducts as $categoriesWithProduct)
                    @php
                            if ($loop->iteration == 4) {
                                break;
                            }
                            @endphp 
                    <div class="tab-pane @if($loop->iteration == 1) active @endif" id="cat{{ $categoriesWithProduct->id }}">
                        <div class="row product-slider">
                            @foreach($categoriesWithProduct->products as $product)
                            <div class="col-12">
                                <!-- single-product-wrap start -->
                                <div class="single-product-wrap">
                                    <div class="product-image">
                                        <a href="{{ URL::to('product-details/'.$product->id) }}"><img style="height:18rem" src="{{ $product->getFirstMediaUrl('image') }}" alt=""></a>
                                        <span class="label-product label-new">new</span>
                                        <div class="quick_view">
                                            <a href="#" title="quick view" class="quick-view-btn" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fa fa-search"></i></a>
                                        </div>
                                        <div class="quick_view">
                                            <a href="#" title="quick view" class="quick-view-btn" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fa fa-search"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3><a href="product-details.html">{{ $product->name }}</a></h3>
                                        <div class="price-box">
                                            <span class="new-price">{{ $product->price }} PKR </span>
                                            <!-- <span class="old-price">$58.49</span> -->
                                        </div>
                                        <div class="product-action">
                                            <a href="{{ URL::to('product-details/'.$product->id) }}" class="add-to-cart" title="Add to cart"><i class="fa fa-plus"></i> Add to cart</a>
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
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                @endisset
                </div>
                <!-- tab-contnt end -->
            </div>
            <!-- product-wrapper end -->
        </div>
    </div>
    <!-- Product Area End -->

    <!-- Banner area start -->
    <div class="banner-area-two section-pb">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <!-- single-banner start -->
                    <div class="single-banner-two mt--30">
                        <a href="shop.html"><img src="{{ asset('website/assets/images/banner/banner_4.png') }}" alt=""></a>
                    </div>
                    <!-- single-banner end -->
                </div>
                <div class="col-lg-6 col-md-6">
                    <!-- single-banner start -->
                    <div class="single-banner-two mt--30">
                        <a href="shop.html"><img src="{{ asset('website/assets/images/banner/banner_5.png') }}" alt=""></a>
                    </div>
                    <!-- single-banner end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Banner area end -->
    
    <!-- Trending Product Area Start -->
    <div class="trending-products-area section-pb">
        <div class="container">
            <div class="row">
           
                <div class="col-lg-4">
                    <div class="single-trend-cetagory mt--30">
                        <div class="section-title-three">
                            <h3>Earrings</h3>
                        </div>
                        <div class="row trend-product-active">
                            <!-- trend-product-wrap start -->
                            <div class="col trend-product-wrap">
                                <!-- trend-single-product start -->
                                 
                                <div class="trend-single-product">
                                    <div class="trend-product-image">
                                        <a href="porduct-details.html"><img src="{{ asset('website/assets/images/product/10.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="trend-product-content">
                                        <h3><a href="#">New Mix Material</a></h3>
                                        <div class="price-box">
                                            <span class="new-price">$77.56</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- trend-single-product end -->
                                <!-- trend-single-product start -->
                                <div class="trend-single-product">
                                    <div class="trend-product-image">
                                        <a href="porduct-details.html"><img src="{{ asset('website/assets/images/product/10.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="trend-product-content">
                                        <h3><a href="#">Printed Summer Dress</a></h3>
                                        <div class="price-box">
                                            <span class="new-price">$86.00</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- trend-single-product end -->
                                <!-- trend-single-product start -->
                                <div class="trend-single-product">
                                    <div class="trend-product-image">
                                        <a href="porduct-details.html"><img src="{{ asset('website/assets/images/product/10.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="trend-product-content">
                                        <h3><a href="#">Printed Dress Mix</a></h3>
                                        <div class="price-box">
                                            <span class="new-price">$44.22</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- trend-single-product end -->
                            </div>
                            <!-- trend-product-wrap end -->
                            <!-- trend-product-wrap start -->
                            <div class="col trend-product-wrap">
                                <!-- trend-single-product start -->
                                <div class="trend-single-product">
                                    <div class="trend-product-image">
                                        <a href="porduct-details.html"><img src="{{ asset('website/assets/images/product/10.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="trend-product-content">
                                        <h3><a href="#">New Mix Material</a></h3>
                                        <div class="price-box">
                                            <span class="new-price">$77.56</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- trend-single-product end -->
                                <!-- trend-single-product start -->
                                <div class="trend-single-product">
                                    <div class="trend-product-image">
                                        <a href="porduct-details.html"><img src="{{ asset('website/assets/images/product/10.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="trend-product-content">
                                        <h3><a href="#">Printed Dress Mix</a></h3>
                                        <div class="price-box">
                                            <span class="new-price">$44.22</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- trend-single-product end -->
                                <!-- trend-single-product start -->
                                <div class="trend-single-product">
                                    <div class="trend-product-image">
                                        <a href="porduct-details.html"><img src="{{ asset('website/assets/images/product10.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="trend-product-content">
                                        <h3><a href="#">Printed Dress1</a></h3>
                                        <div class="price-box">
                                            <span class="new-price">$35.12</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- trend-single-product end -->
                            </div>
                            <!-- trend-product-wrap end -->
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="single-trend-cetagory mt--30">
                        <div class="section-title-three">
                            <h3>Necklaces</h3>
                        </div>
                        <div class="row trend-product-active">
                            <!-- trend-product-wrap start -->
                            <div class="col trend-product-wrap">
                                <!-- trend-single-product end -->
                                <!-- trend-single-product start -->
                                <div class="trend-single-product">
                                    <div class="trend-product-image">
                                        <a href="porduct-details.html"><img src="{{ asset('website/assets/images/product/10.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="trend-product-content">
                                        <h3><a href="#">Printed Dress1</a></h3>
                                        <div class="price-box">
                                            <span class="new-price">$33.00</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- trend-single-product end -->
                                <!-- trend-single-product start -->
                                <div class="trend-single-product">
                                    <div class="trend-product-image">
                                        <a href="porduct-details.html"><img src="{{ asset('website/assets/images/product/10.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="trend-product-content">
                                        <h3><a href="#">Printed Dress1 mix</a></h3>
                                        <div class="price-box">
                                            <span class="new-price">$12.22</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- trend-single-product end -->
                                <!-- trend-single-product start -->
                                <div class="trend-single-product">
                                    <div class="trend-product-image">
                                        <a href="porduct-details.html"><img src="{{ asset('website/assets/images/product10.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="trend-product-content">
                                        <h3><a href="#">New Mix Dress</a></h3>
                                        <div class="price-box">
                                            <span class="new-price">$35.12</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- trend-single-product end -->
                            </div>
                            <!-- trend-product-wrap end -->
                            <!-- trend-product-wrap start -->
                            <div class="col trend-product-wrap">
                                <!-- trend-single-product start -->
                                <div class="trend-single-product">
                                    <div class="trend-product-image">
                                        <a href="porduct-details.html"><img src="{{ asset('website/assets/images/product/10.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="trend-product-content">
                                        <h3><a href="#">New Mix Material</a></h3>
                                        <div class="price-box">
                                            <span class="new-price">$77.56</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- trend-single-product end -->
                                <!-- trend-single-product start -->
                                <div class="trend-single-product">
                                    <div class="trend-product-image">
                                        <a href="porduct-details.html"><img src="{{ asset('website/assets/images/product10.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="trend-product-content">
                                        <h3><a href="#">Printed Dress Mix</a></h3>
                                        <div class="price-box">
                                            <span class="new-price">$44.22</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- trend-single-product end -->
                                <!-- trend-single-product start -->
                                <div class="trend-single-product">
                                    <div class="trend-product-image">
                                        <a href="porduct-details.html"><img src="{{ asset('website/assets/images/product/10.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="trend-product-content">
                                        <h3><a href="#">Printed Dress1</a></h3>
                                        <div class="price-box">
                                            <span class="new-price">$35.12</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- trend-single-product end -->
                            </div>
                            <!-- trend-product-wrap end -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-trend-cetagory mt--30">
                        <div class="section-title-three">
                            <h3>Bracelets</h3>
                        </div>
                        <div class="row trend-product-active">
                            <!-- trend-product-wrap start -->
                            <div class="col trend-product-wrap">
                                <!-- trend-single-product start -->
                                <div class="trend-single-product">
                                    <div class="trend-product-image">
                                        <a href="porduct-details.html"><img src="{{ asset('website/assets/images/product/10.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="trend-product-content">
                                        <h3><a href="#">New Mix Material</a></h3>
                                        <div class="price-box">
                                            <span class="new-price">$77.56</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- trend-single-product end -->
                                <!-- trend-single-product start -->
                                <div class="trend-single-product">
                                    <div class="trend-product-image">
                                        <a href="porduct-details.html"><img src="{{ asset('website/assets/images/product/10.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="trend-product-content">
                                        <h3><a href="#">Printed Summer Dress</a></h3>
                                        <div class="price-box">
                                            <span class="new-price">$86.00</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- trend-single-product end -->
                                <!-- trend-single-product start -->
                                <div class="trend-single-product">
                                    <div class="trend-product-image">
                                        <a href="porduct-details.html"><img src="{{ asset('website/assets/images/product/10.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="trend-product-content">
                                        <h3><a href="#">Printed Dress1</a></h3>
                                        <div class="price-box">
                                            <span class="new-price">$35.12</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- trend-single-product end -->
                            </div>
                            <!-- trend-product-wrap end -->
                            <!-- trend-product-wrap start -->
                            <div class="col trend-product-wrap">
                                <!-- trend-single-product start -->
                                <div class="trend-single-product">
                                    <div class="trend-product-image">
                                        <a href="porduct-details.html"><img src="{{ asset('website/assets/images/product10.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="trend-product-content">
                                        <h3><a href="#">New Mix Material</a></h3>
                                        <div class="price-box">
                                            <span class="new-price">$77.56</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- trend-single-product end -->
                                <!-- trend-single-product start -->
                                <div class="trend-single-product">
                                    <div class="trend-product-image">
                                        <a href="porduct-details.html"><img src="{{ asset('website/assets/images/product10.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="trend-product-content">
                                        <h3><a href="#">Printed Summer Dress</a></h3>
                                        <div class="price-box">
                                            <span class="new-price">$86.00</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- trend-single-product end -->
                                <!-- trend-single-product start -->
                                <div class="trend-single-product">
                                    <div class="trend-product-image">
                                        <a href="porduct-details.html"><img src="{{ asset('website/assets/images/product10.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="trend-product-content">
                                        <h3><a href="#">Printed Dress1</a></h3>
                                        <div class="price-box">
                                            <span class="new-price">$35.12</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- trend-single-product end -->
                            </div>
                            <!-- trend-product-wrap end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Trending Product Area end -->


    <!-- Client Testimonials Area Start -->
    <div class="client-testimonials-area text-black bg-grey  section-ptb">
        <div class="container">
           <div class="row">
                <div class="col-lg-12">
                    <!-- section-title start -->
                    <div class="section-title section-bg-2">
                        <h2>Client Testimonials</h2>
                        <p>What they say</p>
                    </div>
                    <!-- section-title end -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 m-auto">
                    <div class="testimonial-slider">
                        <!-- testimonial-content start -->
                        <div class="testimonial-content testimonial-box-white text-center">
                            <p class="des_testimonial">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias veniam esse adipisci provident optio, eius non ullam ab alias voluptate quos, atque voluptatem quo itaque fuga rem ex corporis</p>
                            <div class="content_author">
                                <div class="author-image">
                                    <img src="{{ asset('website/assets/images/comment/com-author.png') }}" alt="">
                                </div>
                            </div>
                            <p class="des_namepost">orando BLoom</p>
                        </div>
                        <!-- testimonial-content end -->
                        <!-- testimonial-content start -->
                        <div class="testimonial-content testimonial-box-white text-center">
                            <p class="des_testimonial">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias veniam esse adipisci provident optio, eius non ullam ab alias voluptate quos, atque voluptatem quo itaque fuga rem ex corporis</p>
                            <div class="content_author">
                                <div class="author-image">
                                    <img src="{{ asset('website/assets/images/comment/com-author.png') }}" alt="">
                                </div>
                            </div>
                            <p class="des_namepost">orando BLoom</p>
                        </div>
                        <!-- testimonial-content end -->
                        <!-- testimonial-content start -->
                        <div class="testimonial-content testimonial-box-white text-center">
                            <p class="des_testimonial">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias veniam esse adipisci provident optio, eius non ullam ab alias voluptate quos, atque voluptatem quo itaque fuga rem ex corporis</p>
                            <div class="content_author">
                                <div class="author-image">
                                    <img src="{{ asset('website/assets/images/comment/com-author.png') }}" alt="">
                                </div>
                            </div>
                            <p class="des_namepost">orando BLoom</p>
                        </div>
                        <!-- testimonial-content start -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Client Testimonials Area End -->

    <!-- Latest Blog Posts Area start -->
    <div class="latest-blog-post-area section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- section-title start -->
                    <div class="section-title section-bg-3">
                        <h2>Latest Blog Posts </h2>
                        <p>There are latest blog posts</p>
                    </div>
                    <!-- section-title end -->
                </div>
            </div>
            <div class="row latest-blog-slider">
                <div class="col-lg-4">
                    <!-- single-latest-blog start -->
                    <div class="single-latest-blog mt--30">
                        <div class="latest-blog-image">
                            <a href="blog-details.html">
                                <img src="{{ asset('website/assets/images/blog/1.jpg') }}" alt="">
                            </a>
                        </div>
                        <div class="latest-blog-content">
                            <h4><a href="blog-details.html">Work with customizer</a></h4>
                            <div class="post_meta">
                                <span class="meta_date"><span> <i class="fa fa-calendar"></i></span>Mar 05, 2018</span>
                                <span class="meta_author"><span></span>Demo Name</span>
                            </div>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the ...</p>
                        </div>
                    </div>
                    <!-- single-latest-blog end -->
                </div>
                <div class="col-lg-4">
                   <!-- single-latest-blog start -->
                    <div class="single-latest-blog mt--30">
                        <div class="latest-blog-image">
                            <a href="blog-details.html">
                                <img src="{{ asset('website/assets/images/blog/2.jpg') }}" alt="">
                            </a>
                        </div>
                        <div class="latest-blog-content">
                            <h4><a href="blog-details.html">Go to New Horizonts</a></h4>
                            <div class="post_meta">
                                <span class="meta_date"><span> <i class="fa fa-calendar"></i></span>may 17, 2018</span>
                                <span class="meta_author"><span></span>Demo Name</span>
                            </div>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the ...</p>
                        </div>
                    </div>
                    <!-- single-latest-blog end -->
                </div>
                <div class="col-lg-4">
                   <!-- single-latest-blog start -->
                    <div class="single-latest-blog mt--30">
                        <div class="latest-blog-image">
                            <a href="blog-details.html">
                                <img src="{{ asset('website/assets/images/blog/3.jpg') }}" alt="">
                            </a>
                        </div>
                        <div class="latest-blog-content">
                            <h4><a href="blog-details.html">What is Bootstrap?</a></h4>
                            <div class="post_meta">
                                <span class="meta_date"><span> <i class="fa fa-calendar"></i></span>june 11, 2018</span>
                                <span class="meta_author"><span></span>Demo Name</span>
                            </div>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the ...</p>
                        </div>
                    </div>
                    <!-- single-latest-blog end -->
                </div>
                <div class="col-lg-4">
                    <!-- single-latest-blog start -->
                    <div class="single-latest-blog mt--30">
                        <div class="latest-blog-image">
                            <a href="blog-details.html">
                                <img src="{{ asset('website/assets/images/blog/4.jpg') }}" alt="">
                            </a>
                        </div>
                        <div class="latest-blog-content">
                            <h4><a href="blog-details.html">Try comfort work </a></h4>
                            <div class="post_meta">
                                <span class="meta_date"><span> <i class="fa fa-calendar"></i></span>Mar 13, 2018</span>
                                <span class="meta_author"><span></span>Demo Name</span>
                            </div>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the ...</p>
                        </div>
                    </div>
                    <!-- single-latest-blog end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Latest Blog Posts Area End -->

    <!-- Our Brand Area Start -->
    <div class="our-brand-area section-pt-70 section-pb-70 bg-grey ">
        <div class="container">
            <div class="row our-brand-active text-center">
                <div class="col-12">
                    <div class="single-brand">
                        <a href="#"><img src="{{ asset('website/assets/images/brand/1.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="single-brand">
                        <a href="#"><img src="{{ asset('website/assets/images/brand/2.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="single-brand">
                        <a href="#"><img src="{{ asset('website/assets/images/brand/3.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="single-brand">
                        <a href="#"><img src="{{ asset('website/assets/images/brand/4.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="single-brand">
                        <a href="#"><img src="{{ asset('website/assets/images/brand/5.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="single-brand">
                        <a href="#"><img src="{{ asset('website/assets/images/brand/6.png') }}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Brand Area End -->

        @endsection
