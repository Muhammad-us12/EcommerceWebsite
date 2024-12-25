
@extends('adminPanel/master') 
        @section('style')
        <link href="{{ asset('public/adminPanel/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
        @endsection

        @section('sidebare')

        @include('customerPanel/sidebare')
     

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
                <h4 class="page-title">Payment Request</h4>
            </div>
        </div>
    </div>
    <div class="page-title-box">
        <div class="page-title-right">
            
        </div>
        <h4 class="page-title">Payment Request</h4>
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
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-5">
                            Payment Requests List
                        </div>
                        <div class="col-sm-7">
                            <div class="text-sm-end">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#standard-modal">Add New</button>
                            </div>
                        </div><!-- end col-->
                    </div>

                    <div class="table-responsive">
                    <table id="scroll-horizontal-datatable" class="table table-centered w-100 nowrap">
                        <thead class="table-light">
                            <tr>
                                <th>Payment Amount</th>
                                <th>Transaction ID</th>
                                <th>Payment Method</th>
                                <th>Invoice No</th>
                                <th>Payment Date</th>
                                <th>Status</th>
                                <th>Customer</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($paymentRequests as $paymentRequest)
                            <tr>
                                <td>PKR {{ number_format($paymentRequest->payment_amount, 2) }}</td>
                                <td>{{ $paymentRequest->transaction_id }}</td>
                                <td>{{ $paymentRequest->payment_method }}</td>
                                <td>{{ $paymentRequest->invoice_no }}</td>
                                <td>{{ \Carbon\Carbon::parse($paymentRequest->payment_date)->format('d-m-Y') }}</td>
                                <td>
                                    <span class="badge {{ $paymentRequest->status == 'Pending' ? 'bg-warning' : 'bg-success' }}">
                                        {{ $paymentRequest->status }}
                                    </span>
                                </td>
                                <td>
                                    {{ $paymentRequest->customer?->first_name }} {{ $paymentRequest->customer?->last_name }}
                                </td>
                                <td>
                                 
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>

                        </table>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- Edit Servic Type modal -->
    <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Payment Request</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="{{ URL::to('customer/payment_request_submit') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                <div class="row">
                 

                    <!-- Payment Amount -->
                    <div class="col-sm-12">
                        <div class="form-input mb-3">
                            <label for="payment_amount" class="lh-1 text-16 text-light-1">Payment Amount</label>
                            <input type="number" step=".01" id="payment_amount" name="payment_amount" class="form-control" required>
                            @error('payment_amount')
                            <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Transaction Id -->
                    <div class="col-sm-12">
                        <div class="form-input mb-3">
                            <label for="transaction_id" class="lh-1 text-16 text-light-1">Transaction ID</label>
                            <input type="text" id="transaction_id" name="transaction_id" class="form-control" required>
                            @error('transaction_id')
                            <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="col-sm-12">
                        <div class="form-input mb-3">
                            <label for="payment_method" class="lh-1 text-16 text-light-1">Payment Method</label>
                            <input type="text" id="payment_method" name="payment_method" class="form-control" required>
                            @error('payment_method')
                            <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Invoice Number -->
                    <div class="col-sm-12">
                        <div class="form-input mb-3">
                            <label for="invoice_no" class="lh-1 text-16 text-light-1">Invoice Number</label>
                            <input type="text" id="invoice_no" name="invoice_no" class="form-control" required>
                            @error('invoice_no')
                            <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Payment Date -->
                    <div class="col-sm-12">
                        <div class="form-input mb-3">
                            <label for="payment_date" class="lh-1 text-16 text-light-1">Payment Date</label>
                            <input type="date" id="payment_date" name="payment_date" class="form-control" required>
                            @error('payment_date')
                            <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Payment Screenshot -->
                    <div class="col-sm-12">
                        <div class="form-input mb-3">
                            <label for="payment_pic" class="lh-1 text-16 text-light-1">Payment Screenshot</label>
                            <input type="file" id="payment_pic" name="payment_pic" class="form-control" required>
                            @error('payment_pic')
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
<script src="{{ asset('public/adminPanel/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/adminPanel/assets/js/vendor/dataTables.bootstrap5.js') }}"></script>

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

    var addToCartAttributes = [];


function addToCart() {
    var attribute = $('#attribute_selected').val();
    attribute = JSON.parse(attribute);
    console.log(attribute);
    
    // Get Ingrident Data

    if (attribute !== '') {
        if (addToCartAttributes.indexOf(attribute['id']) == -1) {
            addToCartAttributes.push(attribute['id']);
         
            var tableRowHTML = `<tr id="${attribute['id']}">
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
                                            <button class="btn btn-danger btn-sm" type="button" onclick="removeAttribute(${attribute['id']})">X</button>
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

    function removeAttribute(attributeId) {
        console.log('removeAttribute fu');
        
        $('#' + attributeId + '').remove();
        var attributeIndex = addToCartAttributes.indexOf(attributeId)
        addToCartAttributes.splice(attributeIndex, 1);
    }
}

var addToCartExtraPricesArr = [];


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