<!doctype html>
<html class="no-js" lang="zxx">


<!-- Mirrored from htmldemo.net/boyka/boyka/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Sep 2024 09:57:19 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Athnuim</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('website/assets/images/favicon.ico') }}">

    <!-- CSS 
    ========================= -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('website/assets/css/bootstrap.min.css') }}">

    <!-- Font CSS -->
    <link rel="stylesheet" href="{{ asset('website/assets/css/font-awesome.min.css') }}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('website/assets/css/plugins.css') }}">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('website/assets/css/style.css') }}">

    <!-- Modernizer JS -->
    <script src="{{ asset('website/assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body>

    <!-- Main Wrapper Start -->
    <div class="main-wrapper">
        <!-- header-area start -->
        <div class="header-area">
            <!-- header-top start -->
            <div class="header-top bg-grey">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 order-2 order-lg-1">
                            <div class="top-left-wrap">
                                <ul class="phone-email-wrap">
                                    <li><i class="fa fa-phone"></i> (08)123 456 7890</li>
                                    <li><i class="fa fa-envelope-open-o"></i> yourmail@domain.com</li>
                                </ul>
                                <ul class="link-top">
                                    <li><a href="#" title="twitter"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#" title="Rss"><i class="fa fa-rss"></i></a></li>
                                    <li><a href="#" title="Google"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#" title="Youtube"><i class="fa fa-youtube"></i></a></li>
                                    <li><a href="#" title="Instagram"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 order-1 order-lg-2">
                            <div class="top-selector-wrapper">
                                <ul class="single-top-selector">
                                    <!-- Currency Start -->
                                    <li class="currency list-inline-item">
                                        <div class="btn-group">
                                            <button class="dropdown-toggle"> USD $ <i
                                                    class="fa fa-angle-down"></i></button>
                                            <div class="dropdown-menu">
                                                <ul>
                                                    <li><a href="#">Euro €</a></li>
                                                    <li><a href="#" class="current">USD $</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- Currency End -->
                                    <!-- Language Start -->
                                    <li class="language list-inline-item">
                                        <div class="btn-group">
                                            <button class="dropdown-toggle"><img
                                                    src="{{ asset('website/assets/images/icon/la-1.jpg') }}" alt="">
                                                English <i class="fa fa-angle-down"></i></button>
                                            <div class="dropdown-menu">
                                                <ul>
                                                    <li><a href="#"><img
                                                                src="{{ asset('website/assets/images/icon/la-1.jpg') }}"
                                                                alt="">
                                                            English</a></li>
                                                    <li><a href="#"><img
                                                                src="{{ asset('website/assets/images/icon/la-2.jpg') }}"
                                                                alt="">
                                                            Français</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- Language End -->
                                    <!-- Sanguage Start -->
                                    <li class="setting-top list-inline-item">
                                        <div class="btn-group">
                                            <button class="dropdown-toggle"><i class="fa fa-user-circle-o"></i> Setting
                                                <i class="fa fa-angle-down"></i></button>
                                            <div class="dropdown-menu">
                                                <ul>
                                                    <li><a href="my-account.html">My account</a></li>
                                                    <li><a href="checkout.html">Checkout</a></li>
                                                    <li><a href="login-register.html">Sign in</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- Sanguage End -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <!-- Header-top end -->
            <!-- Header-bottom start -->
            <div class="header-bottom-area header-sticky">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 col-4">
                            <!-- logo start -->
                            <div class="logo">
                                <a href="index.html"><img src="{{ asset('website/assets/images/logo/logo.png') }}"
                                        alt=""></a>
                            </div>
                            <!-- logo end -->
                        </div>
                        <div class="col-lg-7 d-none d-lg-block">
                            <!-- main-menu-area start -->
                            <div class="main-menu-area">
                                <nav class="main-navigation">
                                    <ul>
                                      
                                        <li><a href="{{ URL::to('/') }}">Home</a></li>
                                        <li><a href="{{ URL::to('shop') }}">Shop</a></li>
                                        <li><a href="{{ URL::to('register-vendor') }}">Become Vendor</a></li>
                                        <li><a href="about.html">About</a></li>
                                        <li><a href="contact-us.html">Contact us</a></li>
                                        
                                    </ul>
                                </nav>
                            </div>
                            <!-- main-menu-area End -->
                        </div>
                        <div class="col-lg-3 col-8">
                            <div class="header-bottom-right">
                                <div class="block-search">
                                    <div class="trigger-search"><i class="fa fa-search"></i> <span>Search</span></div>
                                    <div class="search-box main-search-active">
                                        <form action="#" class="search-box-inner">
                                            <input type="text" placeholder="Search our catalog">
                                            <button class="search-btn" type="submit"><i
                                                    class="fa fa-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <div class="shoping-cart">
                                    <div class="btn-group">
                                        <!-- Mini Cart Button start -->
                                        <button class="dropdown-toggle"><i class="fa fa-shopping-cart"></i> Cart
                                            (2)</button>
                                        <!-- Mini Cart button end -->

                                        <!-- Mini Cart wrap start -->
                                        <div class="dropdown-menu mini-cart-wrap">
                                            <div class="shopping-cart-content">
                                                <ul class="mini-cart-content">
                                                    
                                                    <!-- Mini-Cart-item start -->
                                                    <li class="mini-cart-item">
                                                        <div class="mini-cart-product-img">
                                                            <a href="#"><img
                                                                    src="{{ asset('website/assets/images/cart/1.jpg') }}"
                                                                    alt=""></a>
                                                            <span class="product-quantity">1x</span>
                                                        </div>
                                                        <div class="mini-cart-product-desc">
                                                            <h3><a href="#">Printed Summer Dress</a></h3>
                                                            <div class="price-box">
                                                                <span class="new-price">$55.21</span>
                                                            </div>
                                                            <div class="size">
                                                                Size: S
                                                            </div>
                                                        </div>
                                                        <div class="remove-from-cart">
                                                            <a href="#" title="Remove"><i class="fa fa-trash"></i></a>
                                                        </div>
                                                    </li>
                                                    <!-- Mini-Cart-item end -->

                                                    <!-- Mini-Cart-item start -->
                                                    <li class="mini-cart-item">
                                                        <div class="mini-cart-product-img">
                                                            <a href="#"><img
                                                                    src="{{ asset('website/assets/images/cart/3.jpg') }}"
                                                                    alt=""></a>
                                                            <span class="product-quantity">1x</span>
                                                        </div>
                                                        <div class="mini-cart-product-desc">
                                                            <h3><a href="#">Faded Sleeves T-shirt</a></h3>
                                                            <div class="price-box">
                                                                <span class="new-price">$72.21</span>
                                                            </div>
                                                            <div class="size">
                                                                Size: M
                                                            </div>
                                                        </div>
                                                        <div class="remove-from-cart">
                                                            <a href="#" title="Remove"><i class="fa fa-trash"></i></a>
                                                        </div>
                                                    </li>
                                                    <!-- Mini-Cart-item end -->

                                                    <li>
                                                        <!-- shopping-cart-total start -->
                                                        <div class="shopping-cart-total">
                                                            <h4>Sub-Total : <span>$127.42</span></h4>
                                                            <h4>Total : <span>$127.42</span></h4>
                                                        </div>
                                                        <!-- shopping-cart-total end -->
                                                    </li>

                                                    <li>
                                                        <!-- shopping-cart-btn start -->
                                                        <div class="shopping-cart-btn">
                                                        <a href="checkout.html">Checkout</a>
                                                        <a href="{{ URL::to('cart') }}">View All</a>
                                                            
                                                        </div>
                                                        <!-- shopping-cart-btn end -->
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- Mini Cart wrap End -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <!-- mobile-menu start -->
                            <div class="mobile-menu d-block d-lg-none"></div>
                            <!-- mobile-menu end -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header-bottom end -->
        </div>
        <!-- Header-area end -->