@extends('layout.master')
@section('title')
    Landlords
@endsection
<link rel="stylesheet" href="{{ URL::asset('../build/libs/gridjs/theme/mermaid.min.css') }}">
<!--@section('css')-->

    
<!--@endsection-->
@section('page-title')
    Landloards
@endsection
@section('body')
    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="position-relative">
                            <div class="modal-button mt-2">
                                    <a href="#" class="create-new">
                                        <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" data-bs-toggle="modal" data-bs-target=".add-new-order">
                                            <i class="mdi mdi-plus me-1"></i>Create New
                                        </button>
                                    </a>
                                    <a href="{{ route('agent.landlord.downloadContact')}}" class="create-new">
                                        <button type="button" class="btn btn-warning btn-rounded waves-effect waves-light mb-2 me-2" style="color:#ffffff"> <i class="fa fa-file-csv"></i> Export Contact
                                        </button>
                                    </a>
                            </div>
                        </div>
                        <div id="table-ecommerce-orders"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        </div>
        <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!--  Create Large modal example -->
        <div class="modal fade add-new-order" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Create Landlord</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frm_create" method="POST" action="{{ route('agent.landlord.create.update') }}" class="cls-crud-simple-save" enctype="multipart/form-data">
                        @csrf
                         <input type="hidden" value="{{ @$getData->id }}" name="id">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Billing-Name">Full Name</label>
                                    <input type="text" class="form-control" name="full_name"   value=""  placeholder="Enter Full Name"
                                        id="AddOrder-Billing-Name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Billing-Name">Email</label>
                                    <input type="email" class="form-control" name="email"   value=""  placeholder="Enter Email"
                                        id="AddOrder-Billing-Name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Billing-Name">Contact Number</label>
                                    <input type="number" class="form-control" name="contact_number"   value=""  placeholder="Enter Contact Number"
                                        id="AddOrder-Billing-Name" required>
                                </div>
                            </div>
                                                     
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Billing-Name">IC / Passport Number</label>
                                    <input type="number" class="form-control" name="passport_number"   value=""  placeholder="Enter IC/ Passport Number"
                                        id="AddOrder-Billing-Name" required>
                                </div>
                            </div>
                            
                        <div class="row mt-2">
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal"><i
                                        class="bx bx-x me-1"></i> Cancel</button>
                                <button type="submit" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#success-btn" id="btn-save-event"><i class="bx bx-check me-1"></i>
                                    Create</button>
                            </div>
                        </div>
                        </form>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

<!-- Edit Modal Start-->
<div class="modal fade edit-order" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Agreement Details</h5>
                                <button type="button" class="btn btn-primary ml-4 pull-right" style="    margin-left: 69% !important;margin-top: -5px;"  id="agrement1_id"><i class="fa fa-print"></i></button>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                              <div class="row">
                                <!-- Left Side Content -->
                                    <div class="col-md-6">
                            <!-- Example usage in modal body -->
                                         <p><strong>Tenant Name:</strong><span id="tenant_name"></span></p>
                                          <p><strong>Tenant IC No:</strong><span id="tenant_ic_no"></span></p>
                                          </div>
                                          <div class="col-md-6">
                                          <p><strong>Landlord Name:</strong><span id="landlord_name"></span></p>
                                          <p><strong>Landlord IC No:</strong><span id="landlord_ic_no"></span></p>
                                    </div>
                                    </div>
                                <div class="row">
                                 <div class="col-md-6">
                                          <p><strong>Agent Name:</strong> <span id="agent_name"></span></p>
                                          <p><strong>Rental Address:</strong><span id="rental_address"></span></p>
                                          <p><strong>Start Date:</strong><span id="rental_startdate"></span></p>
                                          <p><strong>End Date:</strong><span id="rental_enddate"></span></p>
                                          <p><strong>Agent Service:</strong><span id="rental_agent_services"></span></p>
                                  </div>
                                  <div class="col-md-6">
                                <!-- Right Side Content -->
                                          <p><strong>Rental Amount:</strong><span id="rental_amount"></span> per month</p>
                                          <p><strong>Security Deposit:</strong><span id="rental_security_deposit"></span></p>
                                          <p><strong>Utility Deposit:</strong><span id="rental_utility_deposit"></span></p>
                                          <p><strong>Duration:</strong>  <span id="rental_duration"></span> months</p>
                                          <p><strong>Status:</strong>  <span id="rental_status"></span></p>
                                  </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



<div class="modal fade edit-order1" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="myExtraLargeModalLabel">Landlord</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="modal-body">
                            <div class="container-fluid">
                              <div class="row">
                                <!-- Left Side Content -->
                                            <div class="col-md-6" style="font-size: 20px;">
                            <!-- Example usage in modal body -->
                                         <p><strong style="margin-right:10px">Name:</strong><span class="landlord_name"></span></p>
                                          <p><strong style="margin-right:10px">Contact:</strong><span class="landlord_contact"></span></p>
                                          </div>
                                          <div class="col-md-6" style="font-size: 20px;">
                                          <p><strong style="margin-right:10px">Email:</strong><span class="landlord_email"></span></p>
                                          <p><strong style="margin-right:10px">Landlord IC No:</strong><span class="landlord_ic_no"></span></p>
                                            </div>
                                    </div>
                              
                              </div>
                            </div>
                        </div>
                        
                        <input type="hidden" class="edit_id" name="id">

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

    @endsection
    @section('scripts')
        <script src="{{ URL::asset('/build/libs/gridjs/gridjs.umd.js') }}"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


        <script>
                $(document).ready(function(){
                    new gridjs.Grid({
                        columns: [
                            {
                                name: 'Full Name',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                             {
                                name: 'Email',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                                                         {
                                name: 'Contact',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                                                                                     {
                                name: 'IC/Passport Number',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                            {
                                name: 'Status',
                                formatter: (cell) => gridjs.html(`<span class="fw-semibold">${cell}</span>`)
                            },
                                                        {
                                name: 'Birthday Reminder',
                                formatter: (cell) => gridjs.html(`<span class="fw-semibold">${cell}</span>`)
                            },
                            {
                                name: "Action",
                                sort: {
                                  enabled: false
                                },
                                formatter: (function (cell) {
                                  return gridjs.html(`<div class="d-flex gap-3">${cell}</div>`);
                                
                                })
                              },
                              
                        ],
                        pagination: {
                            limit: 7
                        },
                        sort: true,
                        search: true,
                         data : [ 
                                    <?php foreach($templates as $template){ ?>
                                    <?php
                                    
                                $viewButtton='<button title="View Profile" class=" btn  deleteButton  view_landlord" data-id="' .$template->id . '"><i class="fas fa-eye"></i></button>';

                                    ?>
                                    
                                        ['<?=$template->name;?>','<?=$template->email;?>','<?=$template->phone_number;?>','<?=$template->identity_number;?>','<input type="checkbox" value="<?=$template->status;?>"  switch="none" <?=$template->status==1 ? "checked" : "" ;?> /><label for="statusSwitch<?=$template->id?>" data-on-label="on" data-off-label="off"></label>','<input type="checkbox" class="switch-activeB" id="switchb<?=$template->id?>" data-userId="<?=$template->id?>" value="<?=$template->bstatus;?>" switch="none" <?=$template->bstatus == 1 ? "checked" : "" ;?> /><label for="switchb<?=$template->id?>"  data-on-label="on" data-off-label="off"></label>','<button data-id="<?=$template->id?>" data-name="<?=$template->name?>" data-email="<?=$template->email?>" data-phone_number="<?=$template->phone_number;?>" data-identity_number="<?=$template->identity_number;?>"   title="view" class="btn btn-sm btn-success view_tenant"><div class="hidden" style="display:none;"></div><i class="mdi mdi-eye font-size-18"></i></button><button  title="Delete" class="btn btn-sm btn-danger del-btn" data-id="<?=$template->id?>"><i class="mdi mdi-delete font-size-18"></i></button>'],<?php } ?>
                                    
                                ]
                    }).render(document.getElementById("table-ecommerce-orders"));
                
                
                })
                
        </script>
        <script>
//birthday notification status
            //status active/deactive......................
                function showAlert(status, message) {
                    Swal.fire({
                        icon: status ? 'success' : 'error',
                        text: message,
                        timer: 1500,  // Set the duration in milliseconds (1 second)
                        showConfirmButton: false
                    });
                }
            
                // Event listener for switch state change
                $(document).on('change', '.switch-activeB', function () {
                    var id = $(this).attr("data-userId");
                    var _url = "{{ route('agent.landlord.birthday.notification')}}";
                    var csrfToken = "{{ csrf_token() }}"; // Retrieve CSRF token
            
                    $.ajax({
                        type: "POST",
                        url: _url,
                        data: {
                            _token: csrfToken, // Include CSRF token
                            user_id: id
                        },
                        success: function (response) {
                            if (response.success) {
                                if (response.status == 1) {
                                    showAlert(1, "Birthday is activated");
                                    $('.is_active_' + id).html(
                                        '<button class="btn btn-success activate" data-id="' + id +
                                        '"> Active</button>');
                                } else if (response.status == 0) {
                                    showAlert('', "Birthday is deactivated");
                                    $('.is_active_' + id).html(
                                        '<button class="btn btn-danger activate" data-id="' + id +
                                        '"> Deactive</button>');
                                }
                            } else {
                                showAlert(0, "User is deactivate");
                            }
                        }
                    });
                });
                
                //view landlord
                
                $(document).on('click', '.view_tenant', function(){
                    var id = $(this).data('id');
                    var name = $(this).data('name');
                    var email = $(this).data('email');
                    var phone_number = $(this).data('phone_number');
                    var identity_number = $(this).data('identity_number');

                    $(".edit-order1").modal('show');
                    
                    $('.landlord_name').text(name);
                    $('.landlord_email').text(email);
                    $('.landlord_contact').text(phone_number);
                    $('.landlord_ic_no').text(identity_number);
                    $('.edit_id').val(id);
                });
    $(document).ready(function() {
    // General selector to handle both forms
    $('#frm_create, #frm_edit').submit(function(e) {
        e.preventDefault(); 
        var $form = $(this);
        var formAction = $form.attr('action');
        var isCreateForm = $form.attr('id') === 'frm_create';

        $.ajax({
            type: "POST",
            url: formAction,
            data: $form.serialize(),
            success: function(response) {
                // Determine the message based on the form ID
                var message = isCreateForm ? 'Landlord has been created.' : 'Template has been updated.';
                showAlert(true, message);
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
            },
            error: function(error) {
                // Error message also varies by form
                var errorMessage = isCreateForm ? 'Failed to create Agreement.' : 'Failed to update Agreement.';
                showAlert(false, errorMessage);
                console.error(error);
            }
        });
    });
});
                        

            
         //delete Email Template
         
        $(document).on('click', '.del-btn', function() {    
            // $(".del-btn").click(function() {
                var del_id = $(this).attr("data-id");
                var _url = "{{ route('agent.landlord.delete')}}";
                var csrfToken = "{{ csrf_token() }}";
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You wont be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: _url,
                            data: {
                                _token: csrfToken,
                                id: del_id,
                            },
                            success: function(response) {
                                if (response.success) {
                                    $('.delete_' + del_id).remove();
                                    $('.message').addClass('text-success').text(
                                        'Action Performed Successfully.');
                                        window.location.reload();
                                } else {
                                    $('.message').addClass('text-danger').text(
                                        'Action Failed!Please try again later.')
                                }
                            }
                        });
                    }
                });
            });
        </script>
    @endsection
