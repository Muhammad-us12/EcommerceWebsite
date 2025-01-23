
@extends('vendorPanel/master') 
        @section('style')
        <link href="{{ asset('adminPanel/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
        @endsection

        @section('sidebare')

        @include('vendorPanel/sidebare')

        @endsection
         @section('content')       
                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                            @if(session('success'))
                                               

                                               <div id="success-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                   <div class="modal-dialog modal-sm">
                                                       <div class="modal-content modal-filled bg-success">
                                                           <div class="modal-body p-4">
                                                               <div class="text-center">
                                                                   <i class="dripicons-checkmark h1"></i>
                                                                   <h4 class="mt-2">Well Done!</h4>
                                                                   <p class="mt-3">{{ session('success') }}</p>
                                                                   <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">Continue</button>
                                                               </div>
                                                           </div>
                                                       </div><!-- /.modal-content -->
                                                   </div><!-- /.modal-dialog -->
                                               </div>

                                               
                                               @endif

                                               @if(session('error'))
                                               <div id="error-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                   <div class="modal-dialog modal-sm">
                                                       <div class="modal-content modal-filled bg-danger">
                                                           <div class="modal-body p-4">
                                                               <div class="text-center">
                                                                   <i class="dripicons-wrong h1"></i>
                                                                   <h4 class="mt-2">Oh snap!</h4>
                                                                   <p class="mt-3">{{ session('error') }}</p>
                                                                   <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">Continue</button>
                                                               </div>
                                                           </div>
                                                       </div><!-- /.modal-content -->
                                                   </div><!-- /.modal-dialog -->
                                               </div><!-- /.modal -->
                                               @endif
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        
                                    </div>
                                    <h4 class="page-title">Vendor Details</h4>
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
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-sm-5">
                                                <h4 class="page-title">Vendor Details</h4>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                <!-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#standard-modal"><i class="mdi mdi-plus-circle me-2"></i>Add Slider</button> -->
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if($vendor->vendor)
                                                <form action="{{ URL::to('vendor/on-boarding/update/'.$vendor->vendor->id) }}" enctype="multipart/form-data" method="post">
                                                    @else
                                                    <form action="{{ URL::to('vendor/on-boarding/save') }}" enctype="multipart/form-data" method="post">

                                                @endif
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="phone" class="form-label">Name</label>
                                                            <input type="text" name="userName" readonly required value="{{ $vendor->name }}" class="form-control" id="userName" placeholder="Enter userName">
                                                            @error('userName')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="phone" class="form-label">Email</label>
                                                            <input type="text" name="email" readonly required value="{{ $vendor->email }}" class="form-control" id="email" placeholder="Enter email">
                                                            @error('email')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="phone" class="form-label">Phone</label>
                                                            <input type="text" name="phone" required value="{{ $vendor->vendor->phone ?? '' }}" class="form-control" id="phone" placeholder="Enter Phone">
                                                            @error('phone')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                 
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="city" class="form-label">City</label>
                                                            <input type="text" name="city" required value="{{ $vendor->vendor->city ?? '' }}" class="form-control" id="city" placeholder="Enter City">
                                                            @error('city')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="cnic" class="form-label">CNIC</label>
                                                            <input type="text" name="cnic" required value="{{ $vendor->vendor->cnic ?? '' }}" class="form-control" id="cnic" placeholder="Enter CNIC">
                                                            @error('cnic')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="gender" class="form-label">Gender</label>
                                                            <select name="gender" required class="form-control" id="gender">
                                                                <option value="" disabled selected>Select Gender</option>
                                                                <option value="male" @isset($vendor->vendor->gender) {{ $vendor->vendor->gender == 'male' ? 'selected' : '' }} @endisset>Male</option>
                                                                <option value="female" @isset($vendor->vendor->gender) {{ $vendor->vendor->gender == 'female' ? 'selected' : '' }} @endisset>Female</option>
                                                                <option value="other" @isset($vendor->vendor->gender) {{ $vendor->vendor->gender == 'other' ? 'selected' : '' }} @endisset>Other</option>
                                                            </select>
                                                            @error('gender')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="bank_account_number" class="form-label">Bank Account Number</label>
                                                            <input type="text" name="bank_account_number" required value="{{ $vendor->vendor->bank_account_number ?? '' }}" class="form-control" id="bank_account_number" placeholder="Enter Bank Account Number">
                                                            @error('bank_account_number')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="bank_name" class="form-label">Bank Name</label>
                                                            <input type="text" name="bank_name" required value="{{ $vendor->vendor->bank_name ?? '' }}" class="form-control" id="bank_name" placeholder="Enter Bank Name">
                                                            @error('bank_name')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="address" class="form-label">Address</label>
                                                            <input type="text" name="address" required value="{{ $vendor->vendor->address ?? '' }}" class="form-control" id="address" placeholder="Enter Address">
                                                            @error('address')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                  
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-success">Update</button>
                                                    </div>
                                                </div>
                                               


                                             
                                                
                                                </form>
                                            </div>
                                        </div>
                                        
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                     
                        <!-- end row -->

                    </div>

         @endsection

         @section('scripts')
         <script src="{{ asset('adminPanel/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
         <script src="{{ asset('adminPanel/assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
         
            <script>
                   @if(session('success'))
                        $(document).ready(function(){
                            $("#success-alert-modal").modal('show');
                        })  
                    @endif

                    @if(session('error'))
                        $(document).ready(function(){
                                $("#error-alert-modal").modal('show');
                        })
                    @endif

                $("#scroll-horizontal-datatable").DataTable({scrollX:!0,language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}})
            </script>            
         @endsection
                    <!-- container -->

                