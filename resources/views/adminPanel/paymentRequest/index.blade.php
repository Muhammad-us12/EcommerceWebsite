
@extends('adminPanel/master') 
        @section('style')
        <link href="{{ asset('public/adminPanel/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
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
                                       
                                    </div>
                                    <h4 class="page-title">Payment Request List</h4>
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
                                                
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                <a href="{{ URL::to('create_activities') }}" class="btn btn-success" ><i class="mdi mdi-plus-circle me-2"></i>Add New</a>
                                                </div>
                                            </div><!-- end col-->
                                            <div class="col-md-12 m-2">
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
                                                
                                            </div>
                                        </div>
                
                                        <div class="table-responsive">
                                        <table id="scroll-horizontal-datatable" class="table table-centered w-100 nowrap">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Picture</th>
                                                    <th>Invoice No</th>
                                                    <th>Transaction Id</th>
                                                    <th>Payment Amount</th>
                                                    <th>Date</th>
                                                    <th>Method</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @isset($payments_request_data)
                                                    @foreach($payments_request_data as $pay_res)
                                                    
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <img src="{{ $pay_res->getFirstMediaUrl('image') }}" style="height:100px; width:100px;" alt="">
                                                        </td>
                                                        <td>{{ $pay_res->invoice_no }}</td>
                                                        <td>{{ $pay_res->transaction_id }}</td>
                                                        <td class="fw-500">{{ $pay_res->payment_amount }}</td>
                                                        <td>{{ $pay_res->payment_date }}</td>
                                                        <td>{{ $pay_res->payment_method }}</td>
                                                        <td>
                                                            @if($pay_res->status == 'Approve')
                                                            <span class="badge bg-success" onclick="change_payment_status({{ $pay_res->id }},'{{ $pay_res->status }}')">{{ $pay_res->status }}</span> 
                                                            @endif     

                                                            @if($pay_res->status == 'Pending')
                                                            <span class="badge bg-danger" onclick="change_payment_status({{ $pay_res->id }},'{{ $pay_res->status }}')">{{ $pay_res->status }}</span> 
                                                            @endif
                                                            
                                                            @if($pay_res->status == 'Reject')
                                                            <span class="badge bg-warning" onclick="change_payment_status({{ $pay_res->id }},'{{ $pay_res->status }}')">{{ $pay_res->status }}</span> 
                                                            @endif
                                                            
                                                            
                                                        </td>
                                                    
                                                    </tr>
                                                    @endforeach
                                                @endisset
                                            </tbody>
                                        </table>
                                            {!! $payments_request_data->links() !!}
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                     
                        <!-- end row -->

                    </div>

                    <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-modal="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="standard-modalLabel">Update Status</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                </div>
                                <div class="modal-body">
                                <form action="{{ URL::to('admin/customer-payment-requests/update-payment-status') }}" method="post">
                                    @csrf
                                    <div class="row">
                                                <div class="col-md-12">
                                                    <label for="">Select Payment Status</label>
                                                    <select id="payment_status" class="form-control" name="payment_status" id="">
                                                        <option value="Approve">Approve</option>
                                                        <option value="Reject">Reject</option>
                                                        <option value="Pending">Pending</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 mt-2">
                                                    <label for="">Message</label>
                                                    <input type="text" id="payment_id" name="payment_id" hidden>
                                                    <textarea name="message" class="form-control" id="" cols="30" rows="5"></textarea>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" onclick="return confirm('Are You Sure')" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
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
 function change_payment_status(id,status){
                    $('#standard-modal').modal('show');
                    $('#payment_id').val(id);
                    $('#payment_status').val(status).change();
                }


</script>


@endsection
<!-- container -->