
<?php $__env->startSection('title'); ?>
    Email Template
<?php $__env->stopSection(); ?>
<link rel="stylesheet" href="<?php echo e(URL::asset('../build/libs/gridjs/theme/mermaid.min.css')); ?>">
<!--<?php $__env->startSection('css'); ?>-->
    
<!--<?php $__env->stopSection(); ?>-->
<?php $__env->startSection('page-title'); ?>
    Email Template
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
                                            <i class="mdi mdi-plus me-1"></i>Create New
                                        </button>
                                    </a>
                            </div>
                        </div>
                        <p class="text-danger">To activate the template, please deactivate the active template and then activate another template. Thanks.</p>
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
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Create Email Template</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frm_create" method="POST" action="<?php echo e(route('email.template.create.update')); ?>" class="cls-crud-simple-save" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                         <input type="hidden" value="<?php echo e(@$getData->id); ?>" name="id">
                        <div class="row">
                         
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Billing-Name">Name</label>
                                    <input type="text" class="form-control" name="name"   value=""  placeholder="Name"
                                        id="AddOrder-Billing-Name" required>
                                </div>
                            </div>
                                <!--<div class="col-md-3">-->
                                <!--    <div class="mb-3">-->
                                <!--    <label class="form-label" for="AddOrder-Billing-Name">Select Email Type</label>-->
                                <!--            <select id="emailType" name="emailType" class="form-control">-->
                                <!--                <option value="reminder" <?php echo e(@$getData && $getData->emailType === 'reminder' ? 'selected' : ''); ?>>Reminder Email</option>-->
                                <!--                <option value="login" <?php echo e(@$getData && $getData->emailType === 'login' ? 'selected' : ''); ?>>Login Email</option>-->
                                <!--            </select>-->
                                <!--    </div>-->
                                <!--</div>-->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Total">Descriptions</label>
                                    <textarea type="text" name="description" class="form-control" placeholder=" Description here....." id="AddOrder-Total" required rows="5" style="height: 200px; resize: vertical;"></textarea>
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
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Email Template</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frm_edit" method="POST" action="<?php echo e(route('email.template.create.update')); ?>" class="cls-crud-simple-save" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                         
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Billing-Name">Name</label>
                                    <input type="text" class="form-control edit_title" name="name"   value="<?php echo e(@$getData->name ??  old('name')); ?>"  placeholder="Message Template"
                                        id="AddOrder-Billing-Name" required>
                                </div>
                            </div>
                                <!--<div class="col-md-3">-->
                                <!--    <div class="mb-3">-->
                                <!--    <label class="form-label" for="AddOrder-Billing-Name">Select Email Type</label>-->
                                <!--            <select id="emailType" name="emailType" class="form-control">-->
                                <!--                <option value="reminder" <?php echo e(@$getData && $getData->emailType === 'reminder' ? 'selected' : ''); ?>>Reminder Email</option>-->
                                <!--                <option value="login" <?php echo e(@$getData && $getData->emailType === 'login' ? 'selected' : ''); ?>>Login Email</option>-->
                                <!--            </select>-->
                                <!--    </div>-->
                                <!--</div>-->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Total">Descriptions</label>
                                    <textarea type="text" name="description" class="form-control edit_desc" placeholder="Descriptions .... " id="AddOrder-Total" required rows="5" style="height: 200px; resize: vertical;"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal"><i
                                        class="bx bx-x me-1"></i> Cancel</button>
                                <button type="submit" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="" id="btn-save-event"><i class="bx bx-check me-1"></i>
                                    Update</button>
                            </div>
                        </div>
                        <input type="hidden" class="edit_id" name="id">
                        </form>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

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
                              
                        ],
                        pagination: {
                            limit: 7
                        },
                        sort: true,
                        search: true,
                         data : [ 
                                    <?php foreach($templates as $template){ ?>
                                    
                                        ['<?=$template->name;?>','<?=$template->description;?>','<input type="checkbox" class="switch-active" id="switch<?=$template->id?>" data-id="<?=$template->id?>" value="<?=$template->status;?>" switch="none" <?=$template->status==1 ? "checked" : "" ;?> /><label for="switch<?=$template->id?>"  data-on-label="on" data-off-label="off"></label>','<button data-id="<?=$template->id?>" data-title="<?=$template->name?>"  title="Edit" class="btn btn-sm btn-success edit-birthday"><div class="hidden" style="display:none;"><?=json_encode($template->description);?></div><i class="mdi mdi-pencil font-size-18"></i></button><button   title="Delete" class="btn btn-sm btn-danger del-btn" data-id="<?=$template->id?>"><i class="mdi mdi-delete font-size-18"></i></button>'],<?php } ?>
                                    
                                ]
                    }).render(document.getElementById("table-ecommerce-orders"));
                
                
                })
                
        </script>
        <script>


        //edit Email Template
        
                   $(document).on('click', '.edit-birthday', function(){
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
            // Function to show a SweetAlert message
        function showAlert(status, message) {
            Swal.fire({
                icon: status ? 'success' : 'error',
                text: message,
                timer: 1500,  // Set the duration in milliseconds (1.5 seconds)
                showConfirmButton: false
            });
        }
    $(document).on('change', '.switch-active', function () {
        var currentSwitch = $(this);
        var id = currentSwitch.attr("data-id");
        var _url = "<?php echo e(route('email.template.active.update.deactive')); ?>";
        var csrfToken = "<?php echo e(csrf_token()); ?>";

        // Check if any other switch is already on
        var otherSwitchesOn = $('.switch-active:checked').not(currentSwitch).length > 0;

        if (otherSwitchesOn) {
            // Show a message or handle the case where another switch is already on
            showAlert(0, "Only one switch can be active at a time.");
            currentSwitch.prop('checked', false); // Revert the state of the current switch
        } else {
            // Proceed with the AJAX request
            $.ajax({
                type: "POST",
                url: _url,
                data: {
                    _token: csrfToken,
                    id: id
                },
                success: function (response) {
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
                                    '"> Deactive</button>');                        }
                    } else {
                        showAlert(0, "User is deactivated");
                    }
                }
            });
        }
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
 
            
         //delete Email Template
         
        $(document).on('click', '.del-btn', function() {    
            // $(".del-btn").click(function() {
                var del_id = $(this).attr("data-id");
                var _url = "<?php echo e(route('email.template.delete')); ?>";
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
        </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master-inner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\wamp\www\realtagportal\resources\views/emailtemplate/index.blade.php ENDPATH**/ ?>