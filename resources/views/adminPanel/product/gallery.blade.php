
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
            <div class="page-title-box">
                <div class="page-title-right">
                    <form class="d-flex">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-light" id="dash-daterange">
                            <span class="input-group-text bg-primary border-primary text-white">
                                <i class="mdi mdi-calendar-range font-13"></i>
                            </span>
                        </div>
                        <a href="javascript: void(0);" class="btn btn-primary ms-2">
                            <i class="mdi mdi-autorenew"></i>
                        </a>
                        <a href="javascript: void(0);" class="btn btn-primary ms-1">
                            <i class="mdi mdi-filter-variant"></i>
                        </a>
                    </form>
                </div>
                <h4 class="page-title">Product Gallery</h4>
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
                            Product Gallery
                        </div>
                        <div class="col-sm-7">
                            <div class="text-sm-end">
                            @php 
                                $count = count($productGalley);
                                if($count < 3){
                                    @endphp
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#standard-modal">Add New</button>
                                    @php
                                }

                            @endphp
                            
                            
                            </div>
                        </div><!-- end col-->
                    </div>
                        <div class="row mb-2">
                            @isset($productGalley)
                                @foreach($productGalley as $productGalley)
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <img src="{{ $productGalley->getUrl() }}" style="width: 100%" height="400px" alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <a href="{{ URL::to('admin/product/gallery/'.$productGalley->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this?');"  class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @endisset
                          
                        </div>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>

    <!-- Standard modal -->
    <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Add Gallery</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form action="{{ URL::to('/admin/product/'.$product->id.'/gallery') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Picture</label>
                                    <input type="file" multiple value="{{ $product->thumbnail }}" id="thumbnail" name="gallery[]" class="form-control">
                                    @error('gallery')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                        </div>
                    </div>
                    

                

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    
    <!-- Edit Servic Type modal -->
    <div id="fieldServiceTypeEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fieldServiceTypeEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="fieldServiceTypeEditLabel">Edit Category</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form action="{{ route('category.update') }}" method="post">
                    @csrf
                    <input type="hidden" name="fieldServicesID" id="fieldService-id-field">
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Category Name</label>
                                    <input type="text" id="name" name="name" class="form-control">
                                    <input type="text" id="category_id" hidden name="categoryId" class="form-control">
                                    @error('name')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- end row -->

</div>
@endsection

@section('scripts')
<script src="{{ asset('adminPanel/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminPanel/assets/js/vendor/dataTables.bootstrap5.js') }}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $("#scroll-horizontal-datatable").DataTable({
        scrollX: !0,
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            }
        },
        drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
        }
    })
    console.log('page is load now');
</script>


<script>
    $('#fieldServiceTypeEdit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        $.ajax({
            url: "{{ URL::to('admin/categories/') }}/" + id,
            method: 'GET',
            success: function (data) {
                console.log(data);
                
                console.log(data.data.category.id);
                console.log(data.data.category.name);
                
                $('#category_id').val((data.data.category.id));
                $('#name').val(data.data.category.name);

            }
        });
    });


    fetchSubCategory = () => {
        var categoryId = $('#category_id').val();
        $.ajax({
            url: "{{ URL::to('admin/categories') }}" + "/" + categoryId + "/sub-categories",
            type: 'GET',
            data: {},
            success: function(data) {
                console.log(data);
                let subCategoryHtml = ``;
                data.data.subCategories.
                forEach((subcategory) => {
                    subCategoryHtml += `<option value="${subcategory['id']}">${subcategory['name']}</option>`

                });

                $('#sub_category_id').html(subCategoryHtml);
            }
        });
    }

    fetchSubCategory();
</script>


@endsection
<!-- container -->