
@extends('adminPanel/master') 
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
                <h4 class="page-title">Product</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                        <div class="col-sm-5">
                            Product
                        </div>
                        <div class="col-sm-7">
                            <div class="text-sm-end">
                                <a href="{{ URL::to('vendor/product') }}" class="btn btn-primary">Add New</a>
                            </div>
                        </div><!-- end col-->
                    </div>
                 
                    <form action="{{ route('vendor.product.update', $product->id) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="row mb-2">
                         

                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Name</label>
                                    <input type="text" id="name" name="name" value="{{ $product->name }}" required class="form-control">
                                    @error('name')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Cost Price</label>
                                    <input type="number" step="any" id="cost_price" name="cost_price" value="{{ $product->cost_price }}" required class="form-control">
                                    @error('cost_price')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Rent Price</label>
                                    <input type="number" step="any" id="price" name="price" value="{{ $product->price }}" required class="form-control">
                                    @error('price')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Rent Days</label>
                                    <input type="number" id="rent_for_days" name="rent_for_days" value="{{ $product->rent_for_days }}" min="1" required class="form-control">
                                    @error('rent_for_days')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Change Status</label>
                                    <select name="status" class="form-control" id="">
                                        <option value="{{ App\Enums\Status::ACTIVE->value }}" disabled {{ $product->status == App\Enums\Status::ACTIVE->value  ? 'selected' : '' }}>Active</option>
                                        <option value="{{ App\Enums\Status::DISABLED->value }}" {{ $product->status == App\Enums\Status::DISABLED->value  ? 'selected' : '' }}>Disable</option>
                                        <option value="{{ App\Enums\Status::PENDING->value }}" {{ $product->status == App\Enums\Status::PENDING->value  ? 'selected' : '' }}>Pending</option>
                                        <option value="{{ App\Enums\Status::SUBMIT_FOR_APPROVAL->value }}" {{ $product->status == App\Enums\Status::SUBMIT_FOR_APPROVAL->value  ? 'selected' : '' }}>Submit For Approval</option>
                                        <option value="{{ App\Enums\Status::IN_REVIEW->value }}" disabled {{ $product->status == App\Enums\Status::IN_REVIEW->value  ? 'selected' : '' }}>In Review</option>
                                        <option value="{{ App\Enums\Status::REJECTED->value }}" disabled {{ $product->status == App\Enums\Status::REJECTED->value  ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                    @error('cost_price')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Size</label>
                                    <select class="form-select" name="size" required id="example-select">
                                        <option value="{{ App\Enums\ProductSize::X_SMALL->value }}" {{ $product->size == App\Enums\ProductSize::X_SMALL->value ? 'selected' : '' }}>X Small</option>
                                        <option value="{{ App\Enums\ProductSize::SMALL->value }}" {{ $product->size == App\Enums\ProductSize::SMALL->value ? 'selected' : '' }}>Small</option>
                                        <option value="{{ App\Enums\ProductSize::MEDIUM->value }}" {{ $product->size == App\Enums\ProductSize::MEDIUM->value ? 'selected' : '' }}>Medium</option>
                                        <option value="{{ App\Enums\ProductSize::LARGE->value }}" {{ $product->size == App\Enums\ProductSize::LARGE->value ? 'selected' : '' }}>Large</option>
                                        <option value="{{ App\Enums\ProductSize::X_LARGE->value }}" {{ $product->size == App\Enums\ProductSize::X_LARGE->value ? 'selected' : '' }}>X Large</option>
                                    </select>
                                    @error('size')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Select Brand</label>
                                    <select class="form-select" name="brand_id" required id="example-select">
                                        @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Security Deposit</label>
                                    <input type="number" step="any" id="security_deposit" name="security_deposit" value="{{ $product->security_deposit }}" required class="form-control">
                                    @error('security_deposit')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Select Category</label>
                                    <select class="form-select" name="category_id" required onchange="fetchSubCategory()" id="category_id">
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Sub Category</label>
                                    <select class="form-select" name="subcategory_id" required id="sub_category_id">
                                        @foreach($subCategories as $subCategory)
                                        <option value="{{ $subCategory->id }}" {{ $product->subcategory_id == $subCategory->id ? 'selected' : '' }}>{{ $subCategory->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('subcategory_id')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-10">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Picture</label>
                                    <input type="file" step="any" id="thumbnail" name="thumbnail" class="form-control">
                                    @error('thumbnail')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <img src="{{ $product->getFirstMediaUrl('image') }}" style="width: 100px" alt="">
                                </div>
                            </div>
                            

                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" id="">{{ $product->description }}</textarea>
                                </div>
                            </div>


                            <div class="col-sm-10">
                                <div class="mb-3">
                                    <h4>Product Measurement</h4>
                                    <label for="example-input-normal" class="form-label">Select Product Attribute</label>
                                    <select name="" class="form-control" id="attribute_selected">
                                        <option value="">Choose One</option>
                                        @isset($productAttributes)
                                        @foreach($productAttributes as $productAttribute)
                                        <option value="{{ json_encode($productAttribute) }}">{{ $productAttribute->name }}</option>
                                        @endforeach
                                        @endisset
                                    </select>
                                </div>
                            </div>

                            <script>
                                var addToCartAttributes = [];
                                var addToCartExtraPricesArr = [];

                            </script>

                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <button class="btn btn-success" type="button" style="margin-top: 1.8rem;" onclick="addToCart()">Add</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="" class="table table-centered w-100 nowrap">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="15%">Name</th>
                                                <th>Value</th>
                                                <th>Adjustable</th>
                                                <th>Min Value</th>
                                                <th>Max Value</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBody">
                                            @isset($product->productAssignedAttributes)
                                            @foreach($product->productAssignedAttributes as $attribute)
                                            <tr id="attribute{{ $attribute->attribute_id }}">
                                                <td>
                                                    <h5>{{ $attribute->productAttribute->name }}</h5>
                                                    <input type="text" hidden name="attributesId[]" required class="form-control" value="{{ $attribute->attribute_id }}">
                                                </td>
                                                <td>
                                                    <input type="number" step="any" name="attributes[]" id="measurementValue{{ $attribute->id }}" value="{{ $attribute->value }}" required class="form-control">
                                                </td>
                                                <td>
                                                    <select name="adjustable[]" required id="measurementChangeAble{{ $attribute->id }}" attribute-id="{{ $attribute->id }}" class="form-control">
                                                        <option value="false" {{ $attribute->adjustable == 0 ? 'selected' : '' }}>No</option>
                                                        <option value="true" {{ $attribute->adjustable == 1 ? 'selected' : '' }}>Yes</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" step="any" name="min_value[]" id="MinMeasurement{{ $attribute->id }}" value="{{ $attribute->min_value }}" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="number" step="any" name="max_value[]" id="MaxMeasurementChangeAble{{ $attribute->id }}" value="{{ $attribute->max_value }}" class="form-control">
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm" type="button" onclick="removeProductAttribute({{ $attribute->attribute_id }})">X</button>
                                                </td>
                                            </tr>
                                            <script>
                                                addToCartAttributes.push({{ $attribute->attribute_id }});
                                                var addToCartExtraPricesArr = [];

                                            </script>
                                            @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <h4></h4>Remarks From Team</h4>
                                    <p>{{ $product->review_remarks }}</p>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        </div>
                    </form>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>

    <!-- Standard modal -->
    <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Add Product</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form action="{{ URL::to('/admin/product/store') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="modal-body">

                    

                

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
    function removeProductAttribute(attributeId){
         console.log('delete attribute');
         
        $('#attribute' + attributeId + '').remove();
        var attributeIndex = addToCartAttributes.indexOf(attributeId)
        addToCartAttributes.splice(attributeIndex, 1);
        
    }

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

    


function addToCart() {
    var attribute = $('#attribute_selected').val();
    attribute = JSON.parse(attribute);
    console.log(attribute);
    
    // Get Ingrident Data

    if (attribute !== '') {
        if (addToCartAttributes.indexOf(attribute['id']) == -1) {
            addToCartAttributes.push(attribute['id']);
         
            var tableRowHTML = `<tr id="attribute${attribute['id']}">
                                        <td>
                                            <h5>${attribute['name']}</h5>
                                            <input type="text" hidden name="attributesId[]" required class="form-control" value="${attribute['id']}">
                                        </td>
                                        <td>
                                            <input type="number" step="any" name="attributes[]" id="measurementValue${attribute['id']}" required  class="form-control">
                                        </td>
                                        <td>
                                            <select name="adjustable[]" required id="measurementChangeAble${attribute['id']}" attribute-id="${attribute['id']}" class="form-control">
                                                <option value="false">No</option>
                                                <option value="true">Yes</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" step="any" name="min_value[]" id="MinMeasurement${attribute['id']}" class="form-control">
                                        </td>
                                        <td>
                                            <input type="number" step="any" name="max_value[]" id="MaxMeasurementChangeAble${attribute['id']}" class="form-control">
                                        </td>
                                        <td>
                                            <button class="btn btn-danger btn-sm" type="button" onclick="removeProductAttribute(${attribute['id']})">X</button>
                                        </td>
                                    </tr>`;

                    $('#tableBody').append(tableRowHTML);
        } else {
            $('#measurementValue' + attribute + '').focus();
        }

    } else {
        $.toast({
            heading: 'Information',
            text: "Please Select Attribute",
            icon: 'error',
            loader: true, // Change it to false to disable loader
            loaderBg: 'error', // To change the background
            postion: "top - right"
        })
    }
}



function addToCartExtraPrices() {
    var extraPrice = $('#extra_prices').val();
    extraPrice = JSON.parse(extraPrice);
    console.log(extraPrice);
    
    // Get Ingrident Data

    if (extraPrice !== '') {
        if (addToCartExtraPricesArr.indexOf(extraPrice['id']) == -1) {
            addToCartExtraPricesArr.push(extraPrice['id']);
         
            var tableRowHTML = `<tr id="${extraPrice['id']}">
                                        <td>
                                            <h5>${extraPrice['name']}</h5>
                                            <input type="text" hidden name="price_ids[]" required class="form-control" value="${extraPrice['id']}">
                                        </td>
                                        <td>
                                            <input type="number" step="any" name="price_values[]" id="extraPrices${extraPrice['id']}" required  class="form-control">
                                        </td>
                                    
                                        <td>
                                            <button class="btn btn-danger btn-sm" type="button" onclick="removeExtraPrice(${extraPrice['id']})">X</button>
                                        </td>
                                    </tr>`;

                    $('#extra_prices_table').append(tableRowHTML);
        } else {
            $('#extraPrices' + extraPrice + '').focus();
        }

    } else {
        $.toast({
            heading: 'Information',
            text: "Please Select Price",
            icon: 'error',
            loader: true, // Change it to false to disable loader
            loaderBg: 'error', // To change the background
            postion: "top - right"
        })
    }
}
    

    function removeExtraPrice(extraPriceID) {
        console.log('removeAttribute fu');
        
        $('#' + extraPriceID + '').remove();
        var extraPriceIndex = addToCartExtraPricesArr.indexOf(extraPriceID)
        addToCartExtraPricesArr.splice(extraPriceIndex, 1);
    }
</script>


@endsection
<!-- container -->