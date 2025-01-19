
@extends('website/includes/master') 
 @section('content')        
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Login</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->
    
   
    <!-- content-wraper start -->
    <div class="content-wraper">
        <div class="container">
        <div class="row">
                <div class="col-lg-7 col-md-12 m-auto">
                    <div class="login-register-wrapper">
                        <!-- login-register-tab-list start -->
                        <div class="login-register-tab-list nav">
                            <a class="active" data-bs-toggle="tab" href="#lg1">
                                <h4> login </h4>
                            </a>
                            
                        </div>
                        <!-- login-register-tab-list end -->
                        <div class="tab-content">
                            <div id="lg1" class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="{{ route('login') }}" method="post">
                                            @csrf
                                            <div class="login-input-box">
                                                <input type="text" name="email" :value="old('email')" required placeholder="Enter Email">
                                                <input type="password" type="password" name="password" required placeholder="Password">
                                            </div>
                                            <div class="button-box">
                                                <div class="login-toggle-btn">
                                                    <input type="checkbox">
                                                    <label>Remember me</label>
                                                    @if (Route::has('password.request'))
                                                    <a href="{{ route('password.request') }}">Forgot Password?</a>
                                                    @endif
                                                </div>
                                                <div class="button-box">
                                                    <button class="login-btn btn" type="submit"><span>Login</span></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wraper end -->
    

        @endsection
