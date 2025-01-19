
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
                                                <h4 class="page-title">Slider List</h4>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#standard-modal"><i class="mdi mdi-plus-circle me-2"></i>Add Slider</button>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                
                                        <div class="table-responsive">
                                            <table id="scroll-horizontal-datatable" class="table table-centered w-100 nowrap">
                                                <thead class="table-light">
                                                    <tr>
                                                      
                                                        <th>ID</th>
                                                        <th>Title1</th>
                                                        <th>Title2</th>
                                                        <th>Short Description</th>
                                                        <th>image</th>
                                                        <th style="width: 85px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @isset($sliders)
                                                        @foreach($sliders as $slider)
                                                    <tr>
                                                        <td>
                                                            {{ $slider->id }}
                                                        </td>
                                                        
                                                       
                                                        <td>
                                                            {{ $slider->title1 }}
                                                        </td>
                                                        <td>
                                                            {{ $slider->title2 }}
                                                        </td>

                                                        <td>
                                                            {{ $slider->shortParagraph }}
                                                        </td>

                                                        <td>
                                                            <img src="{{ $slider->getFirstMediaUrl('images') }}" style="width: 100px" alt="">
                                                        
                                                        </td>
                                                       
                                                        <td class="table-action">
                                                            <a href="{{ URL::to('admin/sliders/'.$slider->id.'/edit') }}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                            <a href="{{ URL::to('admin/sliders/delete/'.$slider->id) }}" 
                                                                onclick="return confirm('Are you sure you want to delete this?');" 
                                                                class="action-icon"> 
                                                                <i class="mdi mdi-delete"></i>
                                                                </a>                                                        
                                                            </td>
                                                    </tr>
                                                        @endforeach
                                                    @endisset


                                                </tbody>
                                            </table>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                     
                        <!-- end row -->

                    </div>

                    <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="standard-modalLabel">Add Slide</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                </div>
                                <div class="modal-body">
                                <form action="{{ URL::to('admin/sliders/save') }}" enctype="multipart/form-data" method="post">
                                        @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Title 1</label>
                                        <input type="text" name="title1" required value="{{ old('title1') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title 1">
                                        @error('title1')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Title 2</label>
                                        <input type="text" name="title2"  required value="{{ old('title2') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title 2">
                                        @error('title2')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Image</label>
                                        <input type="file" name="image" required value="{{ old('image') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                                        @error('image')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Short Paragraph</label>
                                        <textarea name="shortParagraph" class="form-control" required id=""></textarea>
                                        @error('shortParagraph')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror                                       
                                    </div>
                                
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Save changes</button>
                                </div>
                                </form>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
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

            </script>            
         @endsection
                    <!-- container -->

                