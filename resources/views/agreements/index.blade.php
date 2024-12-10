@extends('layout.master-inner')
@section('title')
    Agreements
@endsection
<link rel="stylesheet" href="{{ URL::asset('../build/libs/gridjs/theme/mermaid.min.css') }}">

<!--@section('css')-->
    
<!--@endsection-->
@section('page-title')
    Agreements
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
                                            <i class="mdi mdi-plus me-1"></i>New Agreement
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
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Create New Agreement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frm_create" method="POST" action="{{ route('agreements.create.update') }}" class="cls-crud-simple-save" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                         
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Billing-Name">Title</label>
                                    <input type="text" class="form-control" name="title"     placeholder="Agreement Title"
                                        id="AddOrder-Billing-Name">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Total">Descriptions</label>
                                    <textarea type="text" name="descriptions" class="form-control" placeholder="Descriptions .... " id="AddOrder-Total" required rows="5" style="height: 200px; resize: vertical;"></textarea>
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
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Create New Agreement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frm_edit" method="POST" action="{{ route('agreements.create.update') }}" class="cls-crud-simple-save" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                         
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Billing-Name">Title</label>
                                    <input type="text" class="form-control edit_title" name="title"   value="{{ @$getData->title ??  old('title') }}"  placeholder="Agreement Title"
                                        id="AddOrder-Billing-Name">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Total">Descriptions</label>
                                    <textarea type="text" name="descriptions" class="form-control edit_desc" placeholder="Descriptions .... " id="AddOrder-Total" required rows="5" style="height: 200px; resize: vertical;"></textarea>
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

        <!-- created successfully  modal  -->
        <div id="#success-btn" class="modal fade" tabindex="-1" aria-labelledby="success-btnLabel" aria-hidden="true"
            data-bs-scroll="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-center">
                            <i class="bx bx-check-circle display-1 text-success"></i>
                            <h4 class="mt-3">Agreement Created Successfully</h4>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        


    @endsection
    @section('scripts')
        <script src="{{ URL::asset('/build/libs/gridjs/gridjs.umd.js') }}"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


        <script>
                $(document).ready(function(){
                    new gridjs.Grid({
                        columns: [
                            {
                                name: 'Title',
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
                                
                                    //{{route('user.agreements.edit')}}
                                    //{{route('agreements.delete')}}
                                })
                              }
                        ],
                        pagination: {
                            limit: 7
                        },
                        sort: true,
                        search: true,
                         data : [ 
                                    <?php foreach($agreements as $agreement){ ?>
                                        ['<?=$agreement->title;?>','<input type="checkbox" class="switch-active" id="switch<?=$agreement->id?>" data-id="<?=$agreement->id?>" value="<?=$agreement->status;?>" switch="none" <?=$agreement->status==1 ? "checked" : "" ;?> /><label for="switch<?=$agreement->id?>"  data-on-label="on" data-off-label="off"></label>','<button data-id="<?=$agreement->id?>" data-title="<?=$agreement->title?>"  title="Edit" class="btn btn-sm btn-success edit-agreement"><div class="hidden" style="display:none;"><?=json_encode($agreement->descriptions);?></div><i class="mdi mdi-pencil font-size-18"></i></button><button   title="Delete" class="btn btn-sm btn-danger del-btn" data-id="<?=$agreement->id?>"><i class="mdi mdi-delete font-size-18"></i></button>'],
                                    <?php } ?>
                                    
                                ]
                    }).render(document.getElementById("table-ecommerce-orders"));
                
                
                })
                
        </script>
        <script>
        function showAlert(status, message) {
            Swal.fire({
                icon: status ? 'success' : 'error',
                text: message,
                timer: 1500,  // Set the duration in milliseconds (1.5 seconds)
                showConfirmButton: false
            });
        }
           $(document).on('click', '.edit-agreement', function(){
                var id = $(this).data('id');
                var title = $(this).data('title');
                var desc = $(this).closest('div').text();
                // var htmlContent = decodeURIComponent(desc);

                $(".edit-order").modal('show');
                
                $('.edit_title').val(title);
                $('.edit_desc').val(desc);
                $('.edit_id').val(id);
            });
            
//submit form alert
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
                var message = isCreateForm ? 'Agreement has been created.' : 'Agreement has been updated.';
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

//edit form alert
                // $('#frm_edit').submit(function(e) {
                //     e.preventDefault(); 
                //     var formAction = $(this).attr('action');
                
                //     $.ajax({
                //         type: "POST",
                //         url: formAction,
                //         data: $(this).serialize(),
                //         success: function(response) {
                //             // Show SweetAlert confirmation
                //             showAlert(true, 'Agreement has been updated.');
                
                //             window.location.reload();
                //         },
                //         error: function(error) {
                //             showAlert(false, 'Failed to update Agreement.');
                //             console.error(error);
                //         }
                //     });
                // });
// status active/deactive
            $(document).on('change', '.switch-active', function() {
                var id = $(this).attr("data-id");
                var _url = "{{ route('agreement.active.deactive')}}";
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
                            showAlert(1, "Agreement is activated");
                                $('.is_active_' + id).html(
                                    '<button class="btn btn-success activate" data-id="' + id +
                                    '"> Active</button>');                        
                        } else if (response.status == 0) {
                            showAlert('', "Agreement is deactivated");
                            ('.is_active_' + id).html(
                                    '<button class="btn btn-danger activate" data-id="' + id +
                                    '"> Deactive</button>');
                        }
                    } else {
                        showAlert(0, "User is deactivated");
                    }
                    }
                });
            });
        
        $(document).on('click', '.del-btn', function() {    
            // $(".del-btn").click(function() {
                var del_id = $(this).attr("data-id");
                var _url = "{{ route('agreements.delete')}}";
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
                                        'Action Performed Successfully.')
                                        location.reload();
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
