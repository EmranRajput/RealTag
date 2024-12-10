
<?php $__env->startSection('title'); ?>
    WhatsApp Instances
<?php $__env->stopSection(); ?>
<link rel="stylesheet" href="<?php echo e(URL::asset('../build/libs/gridjs/theme/mermaid.min.css')); ?>">
<!--<?php $__env->startSection('css'); ?>-->
    
<!--<?php $__env->stopSection(); ?>-->
<?php $__env->startSection('page-title'); ?>
WhatsApp Instances
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
                                            <i class="mdi mdi-plus me-1"></i>Add New Instance
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
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Create Instance</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frm_create" method="POST" action="<?php echo e(route('whatsapp.instance.create.update')); ?>" class="cls-crud-simple-save" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                         <!--<input type="hidden" value="<?php echo e(@$instance->id); ?>" name="id">-->
                        <div class="row">
                         
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Billing-Name">Instance Id</label>
                                    <input type="text" class="form-control" name="instance_id"     placeholder="Enter Instance Id"
                                        id="AddOrder-Billing-Name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Billing-Name">Token</label>
                                    <input type="text" class="form-control" name="instance_token"     placeholder="Enter Token"
                                        id="AddOrder-Billing-Name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Billing-Name">Expiry Date</label>
                                    <input type="date" class="form-control" name="instance_expiry"    placeholder="Enter Expiry Date"
                                        id="AddOrder-Billing-Name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Billing-Name">Start Sleep Timer</label>
                                    <input type="text" class="form-control" name="start_value"     placeholder="like 0,1,2,3"
                                        id="AddOrder-Billing-Name" required>
                                </div>
                            </div>
                                 <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Billing-Name">End Sleep Timer </label>
                                    <input type="text" class="form-control" name="end_value"     placeholder="like 0,1,2,3"
                                        id="AddOrder-Billing-Name" required>
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
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Instance</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form id="frm_edit" method="POST" action="<?php echo e(route('whatsapp.instance.create.update')); ?>" class="cls-crud-simple-save" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                           <input type="hidden" class="edit_id" name="id" value="<?php echo e(@$instance->id); ?>">
                            <div class="row clearfix">
                                <div class="col-md-6 col-sm-12">
                                    <label for="last_name">Instance Id :<span class="text-danger">*</span>
                                    </label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control edit_instance_id"  name="instance_id"
                                                placeholder="Enter Instance Id"
                                                value="<?php echo e(@$instance->instance_id ?? old('instance_id')); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 ">
                                    <label for="last_name">Token :<span class="text-danger">*</span>
                                    </label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control edit_instance_token" name="instance_token"
                                                placeholder="Enter Token"
                                                value="<?php echo e(@$instance->instance_token ?? old('instance_token')); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3 ">
                                    <label for="last_name">Expiry :<span class="text-danger">*</span>
                                    </label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="date" class="form-control edit_instance_expiry"
                                                name="instance_expiry" placeholder="Enter Expiry Date"
                                                value="<?php echo e(@$instance->instance_expiry ?? old('instance_expiry')); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6  mt-3 ">
                                    <label for="last_name">Start Sleep Timer :<span class="text-danger">*</span>
                                    </label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="form-control edit_start_value" name="start_value"
                                                placeholder="like 0,1,2,3"
                                                value="<?php echo e(@$instance->start_value ?? old('start_value')); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6  mt-3">
                                    <label for="last_name">End Sleep Timer:<span class="text-danger">*</span>
                                    </label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="form-control edit_end_value" name="end_value"
                                                placeholder="like 8,9,10"
                                                value="<?php echo e(@$instance->end_value ?? old('end_value')); ?>">
                                        </div>
                                    </div>
                                </div>
                               <div class="row mt-2">
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal"><i
                                        class="bx bx-x me-1"></i> Cancel</button>
                                <button type="submit" class="btn btn-success" data-bs-toggle="modal"
                                    id="btn-save-event"><i class="bx bx-check me-1"></i>
                                    Update</button>
                            </div>
                        </div>
                            </div>
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
        <!--                    <h4 class="mt-3">WhatsApp Instance Created Successfully</h4>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div><!-- /.modal-content -->-->
        <!--    </div><!-- /.modal-dialog -->-->
        <!--</div><!-- /.modal -->-->

    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('scripts'); ?>
        <script src="<?php echo e(URL::asset('/build/libs/gridjs/gridjs.umd.js')); ?>"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


        <script>
                $(document).ready(function(){
                    new gridjs.Grid({
                        columns: [
                            {
                                name: 'Instance Id',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                             {
                                name: 'Token',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                            {
                                name: 'Expiry',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
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
                                    <?php foreach($instances as $instance){ ?>
                                        ['<?=$instance->instance_id;?>','<?=$instance->instance_token;?>','<?=$instance->instance_expiry;?>','<button data-id="<?=$instance->id?>" data-instance_id="<?=$instance->instance_id?>" data-instance_token="<?=$instance->instance_token?>" data-instance_expiry="<?=$instance->instance_expiry;?>" data-start_value="<?=$instance->start_value;?>" data-end_value="<?=$instance->end_value;?>"  title="Edit" class="btn btn-sm btn-success edit-birthday"><div class="hidden" style="display:none;"></div><i class="mdi mdi-pencil font-size-18"></i></button><button  title="Delete" class="btn btn-sm btn-danger del-btns" data-id="<?=$instance->id?>" onclick="deleteInstance(<?php echo e($instance->id); ?>)"><i class="mdi mdi-delete font-size-18"></i></button>'],<?php } ?>
                                    
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
        //edit birthday
        



                
                $(document).on('click', '.edit-birthday', function(){
                    var id = $(this).data('id');
                    var instance_id = $(this).data('instance_id');
                    var instance_token = $(this).data('instance_token');
                    var instance_expiry = $(this).data('instance_expiry');
                    var start_value = $(this).data('start_value');
                    var end_value = $(this).data('end_value');
                    
                    $(".edit-order").modal('show');
                    
                    $('.edit_instance_id').val(instance_id);
                    $('.edit_instance_token').val(instance_token);
                    $('.edit_instance_expiry').val(instance_expiry);
                    $('.edit_start_value').val(start_value);
                    $('.edit_end_value').val(end_value);
                    $('.edit_id').val(id);
                });
                function showAlert(status, message) {
                    Swal.fire({
                        icon: status ? 'success' : 'error',
                        text: message,
                        timer: 1500,  // Set the duration in milliseconds (1.5 seconds)
                        showConfirmButton: false
                    });
                }
                
                $('#edit_frm').submit(function(e) {
                    e.preventDefault(); 
                    var formAction = $(this).attr('action');
                
                    $.ajax({
                        type: "POST",
                        url: formAction,
                        data: $(this).serialize(),
                        success: function(response) {
                            // Show SweetAlert confirmation
                            showAlert(true, 'Your instance has been updated.');
                
                                setTimeout(function() {
                                window.location.reload();
                            }, 2000);                        },
                        error: function(error) {
                            showAlert(false, 'Failed to update instance.');
                            console.error(error);
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
                var message = isCreateForm ? 'Instance has been created.' : 'Instance has been updated.';
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
            function deleteInstance(del_id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/deleteInstance/' + del_id,
                            type: 'get',
                            success: function(response) {
                                // Handle the success response
                                if (response.status) {
                                    $('.id_' + del_id).remove();
                                    window.location.reload();
                                }
                            },
                            error: function(xhr) {
                                // Handle any errors
                                console.log('Error: ' + xhr.responseText);
                            }
                        });
                    }
                });
            
            }
 
 
        </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\wamp\www\realtagportal\resources\views/instance/index.blade.php ENDPATH**/ ?>