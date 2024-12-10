@extends('layout.master')
@section('title')
    Tenants
@endsection
<link rel="stylesheet" href="{{ URL::asset('../build/libs/gridjs/theme/mermaid.min.css') }}">
<!--@section('css')-->
    
<!--@endsection-->
@section('page-title')
    Tenants
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
                                    <a href="{{ route('agent.tenant.downloadContact')}}" class="create-new">
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
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Create Tenant</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frm_create" method="POST" action="{{ route('agent.tenants.create.update') }}" class="cls-crud-simple-save" enctype="multipart/form-data">
                        @csrf
                         <!--<input type="hidden" value="{{ @$getData->id }}" name="id">-->
                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Billing-Name">Full Name</label>
                                    <input type="text" class="form-control" name="full_name"     placeholder="Enter Full Name"
                                        id="AddOrder-Billing-Name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Billing-Name">Email</label>
                                    <input type="email" class="form-control" name="email"     placeholder="Enter Email"
                                        id="AddOrder-Billing-Name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Billing-Name">Contact Number</label>
                                    <input type="number" class="form-control" name="contact_number"     placeholder="Enter Contact Number"
                                        id="AddOrder-Billing-Name" required>
                                </div>
                            </div>
                                                     
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Billing-Name">IC / Passport Number</label>
                                    <input type="number" class="form-control" name="passport_number"   placeholder="Enter IC/ Passport Number"
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
    </div>

<!--//view-->
<div class="modal fade edit-order1" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="myExtraLargeModalLabel">Tenant</h3>
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
                                    
                                        ['<?=$template->name;?>','<?=$template->email;?>','<?=$template->phone_number;?>','<?=$template->identity_number;?>','<input type="checkbox" class="switch-active" id="switch<?=$template->id?>" data-id="<?=$template->id?>" value="<?=$template->status;?>" switch="none" <?=$template->status==1 ? "checked" : "" ;?> /><label for="switch<?=$template->id?>"  data-on-label="on" data-off-label="off"></label>','<input type="checkbox" class="switch-activeB" id="switchb<?=$template->id?>" data-userId="<?=$template->id?>" value="<?=$template->bstatus;?>" switch="none" <?=$template->bstatus == 1 ? "checked" : "" ;?> /><label for="switchb<?=$template->id?>"  data-on-label="on" data-off-label="off"></label>','<button data-id="<?=$template->id?>" data-name="<?=$template->name?>" data-email="<?=$template->email?>" data-phone_number="<?=$template->phone_number;?>" data-identity_number="<?=$template->identity_number;?>"   title="view" class="btn btn-sm btn-success view_tenant"><div class="hidden" style="display:none;"></div><i class="mdi mdi-eye font-size-18"></i></button><button  title="Delete" class="btn btn-sm btn-danger del-btn" data-id="<?=$template->id?>"><i class="mdi mdi-delete font-size-18"></i></button>'],<?php } ?>
                                    
                                ]
                    }).render(document.getElementById("table-ecommerce-orders"));
                
                
                })
                
        </script>
        <script>
        //view
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
                
                //status
                 $(document).on('change', '.switch-active', function() {
                var id = $(this).attr("data-id");
                var _url = "{{ route('agent.tenants.active.update.deactive')}}";
                var csrfToken = "{{ csrf_token() }}"; // Retrieve CSRF token
            
                $.ajax({
                    type: "POST",
                    url: _url,
                    data: {
                        _token: csrfToken, // Include CSRF token
                        id: id
                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.status == 1) {
                                showAlert(1, "Tenant is activated");
                                $('.is_active_' + id).html(
                                    '<button class="btn btn-success activate" data-id="' + id +
                                    '"> Active</button>');
                            } else if (response.status == 0) {
                                showAlert('', "Tenant is deactivated");
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
            
//birthday notification status
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
                    
            //form create alert 
                $('#frm_create').submit(function(e) {
                    e.preventDefault(); 
                    var formAction = $(this).attr('action');
                
                    $.ajax({
                        type: "POST",
                        url: formAction,
                        data: $(this).serialize(),
                        success: function(response) {
                            // Show SweetAlert confirmation
                            showAlert(true, 'Tenant has been created.');
                
                                setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        },
                        error: function(error) {
                            showAlert(false, 'Failed to update Template.');
                            console.error(error);
                        }
                    });
                });
            
         //delete Email Template
         
        $(document).on('click', '.del-btn', function() {    
            // $(".del-btn").click(function() {
                var del_id = $(this).attr("data-id");
                var _url = "{{ route('agent.tenants.delete')}}";
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
