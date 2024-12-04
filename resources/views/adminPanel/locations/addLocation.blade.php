
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
                <h4 class="page-title">Locations</h4>
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
                            Location List
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

                                    <th>ID</th>
                                    <th>Name</th>
                                    <th style="width: 85px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($locations)
                                    @foreach($locations as $location)
                                        <tr>
                                            <td>
                                                {{ $location->id }}
                                            </td>

                                            <td>
                                                {{ $location->name }}
                                            </td>
                                            <td class="table-action">
                                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-standard-modal" data-location-id="{{ $location->id }}" class="action-icon text-success"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                <a href="javascript:void(0)" class="action-icon text-danger delete-button" data-location-id="{{ $location->id }}"><i class="mdi mdi-delete-outline"></i></a>
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

    <!-- Standard modal -->
    <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Add Location</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form action="{{ URL::to('admin/location/store') }}" method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Location Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Location Name">
                                    @error('location_name')
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
    
    <!-- Edit modal -->
    <div id="edit-standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edit-standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="edit-standard-modalLabel">Edit Location</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form action="{{ route('location.update') }}" method="post">
                    @csrf
                    <input type="hidden" name="locationId" value="" id="location-id-field">
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Location Name</label>
                                    <input type="text" id="name" name="name" class="form-control" value="">
                                    @error('location_name')
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
    </div><!-- /.End Edit modal -->

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
    $('#edit-standard-modal').on('show.bs.modal', function(event) {
        // console.log('Button clicked!');
        var button = $(event.relatedTarget);
        var location = button.data('location-id'); 
        $(this).find('#location-id-field').val(location);
        $.ajax({
            type: 'GET',
            url: 'location/' + location,
        }).done(function(data) {
            $('#name').val(data.data.name);
            $('#edit-standard-modal').modal('show'); 
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.delete-button').on('click', function(event) {
            event.preventDefault();
            var locationId = $(this).data('location-id');
            var confirmDelete = confirm('Are you sure you want to delete this location?');
            if (confirmDelete) {
            $.ajax({
                type: 'GET',
                url: 'delete-check/' + locationId,
                success: function(data) {
                if (data.can_delete) {
                    $.ajax({
                    type: 'DELETE',
                    url: '/admin/location/delete/' + locationId,
                    success: function(response) {
                        if(response["status"] == true) {
                            window.location.href = "{{route('location.list')}}";
                        }}
                    });
                } else {
                    // alert('Cannot Delete This location yet, This location found in Crop Acres');
                        $.toast({
                        heading: 'Information',
                        text: "Cannot Delete This location yet, This location found in Crop Acres",
                        icon: 'error',
                        loader: true,
                        loaderBg: 'error'
                        })
                    }
                }
            });
            }
        });
    });
</script>

@endsection
<!-- container -->