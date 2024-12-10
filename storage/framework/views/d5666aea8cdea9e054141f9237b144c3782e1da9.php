
<?php $__env->startSection('title'); ?>
    Birthday Template
<?php $__env->stopSection(); ?>
<link rel="stylesheet" href="<?php echo e(URL::asset('../build/libs/gridjs/theme/mermaid.min.css')); ?>">

<!--<?php $__env->startSection('css'); ?>-->
    
<!--<?php $__env->stopSection(); ?>-->
<?php $__env->startSection('page-title'); ?>
    Birthday Template
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
    <body>
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('content'); ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="position-relative">
                            <div class="modal-button mt-2">
                                    <a href="#" class="create-new">
                                        <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" data-bs-toggle="modal" data-bs-target=".add-new-order">
                                            <i class="mdi mdi-plus me-1"></i>Add Birthday
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
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Create Birthday Template</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frm_create" method="POST" action="<?php echo e(route('birthday.template.create.update')); ?>" class="cls-crud-simple-save" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                         <input type="hidden" value="<?php echo e(@$getData->id); ?>" name="id">
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
                                    <!-- <button class="addNumber btn btn-primary btn-sm"
                                        type="button">{phone_number}</button> -->
                                </div>
                                <div class="col-sm-12">
                                    <label for="last_name">Description :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line border-dark">
                                            <textarea class="form-control description" rows="3"
                                                placeholder=" Hi {name},happy birthday to you and hope you have a nice day !"
                                                name="description"></textarea>
                                        </div>
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
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Birthday Template</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frm_edit" method="POST" action="<?php echo e(route('birthday.template.create.update')); ?>" class="cls-crud-simple-save" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                         
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Billing-Name">Name</label>
                                    <input type="text" class="form-control edit_title" name="name"   value="<?php echo e(@$getData->name ??  old('name')); ?>"  placeholder="Birthday Template"
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
                                    <!-- <button class="addNumber btn btn-primary btn-sm"
                                        type="button">{phone_number}</button> -->
                                </div>
                                <div class="col-sm-12">
                                    <label for="last_name">Description :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line border-dark">
                                            <textarea class="form-control description" rows="3"
                                                placeholder=" Hi {name},happy birthday to you and hope you have a nice day !"
                                                name="description"><?php echo e(@$getData->description); ?></textarea>
                                        </div>
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
        <!--<div id="success-btn" class="modal fade" tabindex="-1" aria-labelledby="success-btnLabel" aria-hidden="true"-->
        <!--    data-bs-scroll="true">-->
        <!--    <div class="modal-dialog modal-dialog-centered">-->
        <!--        <div class="modal-content">-->
        <!--            <div class="modal-body">-->
        <!--                <div class="text-center">-->
        <!--                    <i class="bx bx-check-circle display-1 text-success"></i>-->
        <!--                    <h4 class="mt-3">Template created successfully</h4>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div><!-- /.modal-content -->-->
        <!--    </div><!-- /.modal-dialog -->-->
        <!--</div><!-- /.modal -->-->

        <!--  view-->
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('scripts'); ?>
        <script src="<?php echo e(URL::asset('/build/libs/gridjs/gridjs.umd.js')); ?>"></script>
        
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
                                  return gridjs.html(`<span class="fw-semibold">${cell}</span>`);
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
                                    <?php
                                    
                                        $deleteButton = ''; 
                                        $switchButton = ''; 
                                        //if(!$template->is_default){
                                            $switchButton='<input type="checkbox" class="switch-active" id="switch' . $template->id . '" data-id="' . $template->id . '" value="' . $template->status . '" switch="none" ' . ($template->status == 1 ? 'checked' : '') . ' /><label for="switch' . $template->id . '" data-on-label="on" data-off-label="off"></label>';
                                         //}
                                        if(!$template->is_default){
                                            $deleteButton='<button class="btn btn-sm btn-danger p-2 deleteButton deleteBirthdays" data-id="' . $template->id . '"><i class=" fas fa-trash text-white p-1"></i></button>';
                                        }
                                        // $defaultButton='<input type="checkbox" class="switch-active" id="switch' . $template->id . '" data-id="' . $template->id . '" value="' . $template->status . '" switch="none" ' . ($template->status == 1 ? 'checked' : '') . ' /><label for="switch' . $template->id . '" data-on-label="on" data-off-label="off"></label>';

                                     ?>
                                    
                                    ['<?=$template->name;?>','<?=$template->description;?>','<?=$switchButton;?>','<button data-id="<?=$template->id?>" data-title="<?=$template->name?>" data-des="<?=$template->description?>" title="Edit" class="btn btn-sm btn-success edit-birthday"><div class="hidden" style="display:none;"></div><i class="mdi mdi-pencil font-size-18"></i></button><?=$deleteButton;?>','<input type="checkbox" name="default_status" value="<?=($template->id)?>"  class="form-check-input" id="switch<?=($template->id)?>" <?= $template->is_default ? "checked" : ""; ?> onclick="handleRadioClick(this)" style="transform: scale(2.0); margin-right: 5px; border-radius:50%" >'],
                                    <?php } ?>
                                ]
                    }).render(document.getElementById("table-ecommerce-orders"));
                
                
                })
                
        </script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <script>


        //edit birthday
        
                   $(document).on('click', '.edit-birthday', function(){
                var id = $(this).data('id');
                var title = $(this).data('title');
                var desc = $(this).data('des');
                $(".edit-order").modal('show');
                
                $('.edit_title').val(title);
                $('.description').val(desc);
                $('.edit_id').val(id);
            });
            
            //status active/deactive......................
     function showAlert(status, message) {
        Swal.fire({
            icon: status ? 'success' : 'error',
            text: message,
            timer: 1500,  // Set the duration in milliseconds (1 second)
            showConfirmButton: false
        });
    }
            $(document).on('change', '.switch-active', function() {
                var id = $(this).attr("data-id");
                var _url = "<?php echo e(route('birthday.template.active.update.deactive')); ?>";
                var csrfToken = "<?php echo e(csrf_token()); ?>"; // Retrieve CSRF token
            
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
                                showAlert(1, "Template is activated");
                                $('.is_active_' + id).html(
                                    '<button class="btn btn-success activate" data-id="' + id +
                                    '"> Active</button>');
                            } else if (response.status == 0) {
                                showAlert('', "Template is deactivated");
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
                var message = isCreateForm ? 'Template has been created.' : 'Template has been updated.';
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
            
         //delete birthday
         
        $(document).on('click', '.deleteBirthdays', function() {    
            // $(".del-btn").click(function() {
                var del_id = $(this).attr("data-id");
                var _url = "<?php echo e(route('birthday.template.delete')); ?>";
                var csrfToken = "<?php echo e(csrf_token()); ?>";
                
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
            
            //add variable 
                function addVariable(variable) {
                var descrip = $('.description');
                descrip.val(descrip.val() + " " + variable);
            }
            
            // Event handler for "addName" button
            $(".addName").click(function() {
                addVariable("{name}");
            });
            
            
    function handleRadioClick(data) {
    $.ajax({
        type: "POST",
        url: "<?php echo e(route('birthday.template.set.default')); ?>",
        data: {
            id: data.value,
            _token: '<?php echo e(csrf_token()); ?>' // Include CSRF token for Laravel POST requests
        },
        success: function(response) {
            if (response.success) {
                showAlert(1, "Template set as default"); // Assuming response.success is a boolean and response.message contains the success message

            } else {
                showAlert(0, response.error); // Assuming response.error contains the error message
               
            }
                    setTimeout(function() {
                    window.location.reload();
                  }, 2000);
        },
        error: function(xhr, status, error) {
            // Handle potential errors here
            console.error("AJAX error:", status, error);
        }
    });
}
        </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master-inner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\wamp\www\realtagportal\resources\views/birthday/index.blade.php ENDPATH**/ ?>