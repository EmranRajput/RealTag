@extends('layout.master-inner')
@section('title')
    Rental Templates
@endsection
<link rel="stylesheet" href="{{ URL::asset('../build/libs/gridjs/theme/mermaid.min.css') }}">
<!--@section('css')-->
    
<!--@endsection-->
@section('page-title')
    Rental Templates
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

        <!--  Extra Large modal example -->
        <div class="modal fade add-new-order" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Rental Templates</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frm_submit" method="POST" action="{{ route('rental.template.create.update') }}" class="cls-crud-simple-save" enctype="multipart/form-data">
                        @csrf
                         <input type="hidden" value="{{ @$getData->id }}" name="id">
                        <div class="row">
                         
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Billing-Name">Name</label>
                                    <input type="text" class="form-control" name="name"   value=""  placeholder="Name"
                                        id="AddOrder-Billing-Name">
                                </div>
                            </div>
                                <div class="col-sm-12">
                                    <h5 class="p-1"> Variables:</h5>
                                </div>
                                <div class="col-sm-12 mt-1 mb-2">
                                    <label for="first_name">Press button to add that <b>variable</b> in
                                        description</label><br>
                                    <button class="addName btn btn-primary btn-sm" type="button">{name}</button>
                                    <button class="addNumber btn btn-primary btn-sm"
                                        type="button">{phone_number}</button>
                                </div>


                                <div class="col-sm-12">
                                    <label for="last_name">Description :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line border-dark">
                                            <textarea class="form-control  description" rows="3"
                                                placeholder=" Hi {name},glad to inform you that ,your rental apartment unit {unit} is due at {duedate}!"
                                                name="description"></textarea>
                                        </div>
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
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Rental Template</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frm" method="POST" action="{{ route('rental.template.create.update') }}" class="cls-crud-simple-save" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                         
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Billing-Name">Name</label>
                                    <input type="text" class="form-control edit_title" name="name"   value="{{ @$getData->name ??  old('name') }}"  placeholder="Birthday Template"
                                        id="AddOrder-Billing-Name">
                                </div>
                            </div>
                                <div class="col-sm-12">
                                    <h5 class="p-1"> Variables:</h5>
                                </div>
                                <div class="col-sm-12 mt-1 mb-2">
                                    <label for="first_name">Press button to add that <b>variable</b> in
                                        description</label><br>
                                    <button class="addName btn btn-primary btn-sm" type="button">{name}</button>
                                    <button class="addNumber btn btn-primary btn-sm"
                                        type="button">{phone_number}</button>
                                </div>


                                <div class="col-sm-12">
                                    <label for="last_name">Description :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line border-dark">
                                            <textarea class="form-control  description" rows="3"
                                                placeholder=" Hi {name},glad to inform you that ,your rental apartment unit {unit} is due at {duedate}!"
                                                name="description">{{  @$getData->description  }}</textarea>
                                        </div>
                                    </div>
                                </div>
                        <div class="row mt-2">
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal"><i
                                        class="bx bx-x me-1"></i> Cancel</button>
                                <button type="submit" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#success-btn" id="btn-save-event"><i class="bx bx-check me-1"></i>
                                    Update</button>
                            </div>
                        </div>
                        <input type="hidden" class="edit_id" name="id">
                        </form>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
<!-- Edit Model End-->

        <!--  successfully modal  -->
        <div id="success-btn" class="modal fade" tabindex="-1" aria-labelledby="success-btnLabel" aria-hidden="true"
            data-bs-scroll="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-center">
                            <i class="bx bx-check-circle display-1 text-success"></i>
                            <h4 class="mt-3">Rental Template Created Successfully</h4>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Modal view-->
        
        <!-- end modal -->
    @endsection
    @section('scripts')
        <script src="{{ URL::asset('/build/libs/gridjs/gridjs.umd.js') }}"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


        <script>
                $(document).ready(function(){
                    new gridjs.Grid({
                        columns: [
                            {
                                name: 'Name',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                             {
                                name: 'Description',
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
                                name: "Action",
                                sort: {
                                  enabled: false
                                },
                                formatter: (function (cell) {
                                  return gridjs.html(`<div class="d-flex gap-3">${cell}</div>`);
                                
                                })
                              },
                              {
                                name: "Default",
                                sort: {
                                  enabled: false
                                },
                                formatter: (function (cell) {
                                  return gridjs.html(`<div class="d-flex gap-3">${cell}</div>`);
                                })
                              }
                        ],
                        pagination: {
                            limit: 7
                        },
                        sort: true,
                        search: true,
                         data : [ 
                                    <?php foreach($templates as $template){ ?>
                                        ['<?=$template->name;?>','<?=json_encode($template->description);?>','<input type="checkbox" class="switch-active" id="switch<?=$template->id?>" data-id="<?=$template->id?>" value="<?=$template->status;?>" switch="none" <?=$template->status==1 ? "checked" : "" ;?> /><label for="switch<?=$template->id?>"  data-on-label="on" data-off-label="off"></label>','<button data-id="<?=$template->id?>" data-title="<?=$template->name?>"  title="Edit" class="btn btn-sm btn-success edit-rental"><div class="hidden" style="display:none;"><?=json_encode($template->descriptions);?></div><i class="mdi mdi-pencil font-size-18"></i></button><button   title="Delete" class="btn btn-sm btn-danger del-btn" data-id="<?=$template->id?>"><i class="mdi mdi-delete font-size-18"></i></button>','<input class="form-check-input " type="radio" name="default_status" id="formRadios1" checked> <label class="form-check-label" for="formRadios1"></label>'],<?php } ?>
                                    
                                ]
                    }).render(document.getElementById("table-ecommerce-orders"));
                
                
                })
                
        </script>
        <script>
    $(".addName").click(function() {
        var desc = $('.description').val();
        $(".description").val($(".description").val() + " {name}");
    });
    $(".addNumber").click(function() {
        var desc = $('.description').val();
        $(".description").val($(".description").val() + " {phone_number}");
    });
    
    //form submit sweet alert
    $('#frm_submit').submit(function(e) {
    e.preventDefault(); // Prevent the form from submitting normally

    // Get the form action attribute
    var formAction = $(this).attr('action');

    // Your AJAX code for form submission
    $.ajax({
        type: "POST",
        url: formAction,
        data: $(this).serialize(),
        success: function(response) {
            // Show SweetAlert confirmation
            showAlert(true, 'Your instance has been updated.');

            // You can perform additional actions here if needed
            // For example, redirect to another page
            window.location.reload;
        },
        error: function(error) {
            // Show SweetAlert error message
            showAlert(false, 'Failed to update instance.');

            // Handle the error scenario if needed
            console.error(error);
        }
    });
});
    
    
    
        //edit Rantal Template
        
                   $(document).on('click', '.edit-rental', function(){
                var id = $(this).data('id');
                var title = $(this).data('title');
                var desc = $(this).closest('div').text();
                // var htmlContent = decodeURIComponent(desc);

                $(".edit-order").modal('show');
                
                $('.edit_title').val(title);
                $('.edit_desc').val(desc);
                $('.edit_id').val(id);
            });
            
            //status active/deactive......................
            function showAlert(status, message) {
            Swal.fire({
                icon: status ? 'success' : 'error',
                text: message,
                timer: 1500,  // Set the duration in milliseconds (1.5 seconds)
                showConfirmButton: false
            });
        }
            $(document).on('change', '.switch-active', function() {
                var id = $(this).attr("data-id");
                var _url = "{{ route('rental.template.active.update.deactive')}}";
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
                                showAlert(1, "Rental Template is activated");
                                $('.is_active_' + id).html(
                                    '<button class="btn btn-success activate" data-id="' + id +
                                    '"> Active</button>');
                            } else if (response.status == 0) {
                                showAlert(1, "Rental Template is deactivated");
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
            
         //delete rental template
         
        $(document).on('click', '.del-btn', function() {    
            // $(".del-btn").click(function() {
                var del_id = $(this).attr("data-id");
                var _url = "{{ route('rental.template.delete')}}";
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
