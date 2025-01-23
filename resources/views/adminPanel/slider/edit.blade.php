
@extends('adminPanel/master') 
        @section('style')
        <link href="{{ asset('adminPanel/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
        @endsection

        @section('sidebare')

        @include('adminPanel/sidebare')

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
                                    <h4 class="page-title">Slider</h4>
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
                                                <h4 class="page-title">Slider Update</h4>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#standard-modal"><i class="mdi mdi-plus-circle me-2"></i>Add Slider</button>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                
                                        <div class="row">
                                            <div class="col-md-12">
                                            <form action="{{ URL::to('admin/sliders/'.$slider->id.'/update') }}" enctype="multipart/form-data" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="exampleInputEmail1" class="form-label">Title 1</label>
                                                            <input type="text" name="title1" required value="{{ $slider->title1 }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title 1">
                                                            @error('title1')
                                                                        <p class="text-danger mt-2">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="exampleInputEmail1" class="form-label">Title 2</label>
                                                            <input type="text" name="title2"  required value="{{ $slider->title2 }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title 2">
                                                            @error('title2')
                                                                        <p class="text-danger mt-2">{{ $message }}</p>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="mb-3">
                                                            <label for="exampleInputEmail1" class="form-label">Image</label>
                                                            <input type="file" name="image" value="{{ old('image') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                                                            @error('image')
                                                                        <p class="text-danger mt-2">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <img src="{{ $slider->getFirstMediaUrl('images') }}" style="width: 100px" alt="">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="exampleInputEmail1" class="form-label">Short Paragraph</label>
                                                            <textarea name="shortParagraph" class="form-control" required id="">{{ $slider->shortParagraph }}</textarea>
                                                            @error('shortParagraph')
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

                