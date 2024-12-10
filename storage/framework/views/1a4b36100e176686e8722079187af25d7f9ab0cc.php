
<?php $__env->startSection('title'); ?>
    History
<?php $__env->stopSection(); ?>
<link rel="stylesheet" href="<?php echo e(URL::asset('../build/libs/gridjs/theme/mermaid.min.css')); ?>">
<!--<?php $__env->startSection('css'); ?>-->
    
<!--<?php $__env->stopSection(); ?>-->
<?php $__env->startSection('page-title'); ?>
    History
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
                           
                        </div>
                        <div id="table-ecommerce-orders"></div>
                    </div>
                </div>
            </div>
        </div>

        </div>
        <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        
<!-- view Modal Start-->

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
<!-- View Model End-->
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('scripts'); ?>
        <script src="<?php echo e(URL::asset('/build/libs/gridjs/gridjs.umd.js')); ?>"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script>
                $(document).ready(function(){
                    new gridjs.Grid({
                        columns: [
                            {
                                name: 'FileName',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                             {
                                name: 'Pending',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                              {
                                name: 'Sent',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                             {
                                name: 'Failed',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                                                         {
                                name: 'Total Count',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                            {
                                name: 'Status',
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                        ],
                      pagination: {
                        limit: 7
                      },
                      sort: true,
                      search: true,
                         data : [ 
                                      <?php foreach($excelFiles as $file) {
                                    switch ($file->status) {
                                        case 0: // Pending
                                            $buttonText = 'Pending';
                                            $buttonClass = 'btn-primary';
                                            break;
                                        case 1: // Success
                                            $buttonText = 'Success';
                                            $buttonClass = 'btn-success';
                                            break;
                                        default:
                                            // Handle unexpected $file->status
                                            $buttonText = 'Unknown Status';
                                            $buttonClass = 'btn-warning';
                                    }
                                        $statusButton = '<button class=\"btn ' . $buttonClass . '\">' . $buttonText . '</button>';
                                    ?>
                                        ['<a href="<?php echo e(route('show.file.contacts', ['id' => $file->id])); ?>"><?=$file->file_name;?></a>','<?=$file->whats_app_msgs_pending_count ?? '--';?>','<?=$file->whats_app_msgs_sent_count ?? '--';?>','<?=$file->whats_app_msgs_failed_count ?? '--';?>','<?=$file->whats_app_msgs_all_count ?? '--';?>','<?=$file=$statusButton;?>'],<?php } ?>
                                ]
                    }).render(document.getElementById("table-ecommerce-orders"));
                
                
                })
                
        </script>
<script>
//search role by dropdown
 var dropdownItems = document.querySelectorAll('.dropdown-item');
    dropdownItems.forEach(function(item) {
        item.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior

            // Get the selected role value
            var selectedRole = this.getAttribute('data-value');

            // Perform the search based on the selected role
            if (selectedRole !== "") {
                // Redirect to the search URL with the selected role
                window.location.href = "<?php echo e(route('show.users')); ?>?role=" + selectedRole;
            }
        });
    });

</script>
        <script>
        //view user profile
        $(document).on('click', '.edit-birthday', function() {
            var id = $(this).attr("data-id");
            // Assuming '_url' is correctly passed from the server to the client, replace it with a valid URL if necessary
            var _url = "<?php echo e(route('show.getUserProfile')); ?>"; // Example path, replace with your actual path
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
                        // Assuming 'response.users' is an object containing user data. Adjust based on your actual response structure
                        var user_status = response.users.status != 1 ? "Deactivated" : "Active";
                        
                     var user_role;
                    if (response.users.role == 1) {
                        user_role = "Admin";   
                    } else if (response.users.role == 2) {
                        user_role = "Agent";   
                    } else if (response.users.role == 3) {
                        user_role = "Landlord";   
                    } else {
                        user_role = "Tenant";
                    }
        
                        var profilePhotoPath = response.users.profile_photo ? '/public/uploads/profile/general/' + response.users.profile_photo : '/public/uploads/profile/general/default.png';
                        
                        $("#profile").attr("src", profilePhotoPath);
                        $("#user_name").text(response.users.name);
                        $("#user_email").text(response.users.email);
                        $("#user_id_number").text(response.users.identity_number);
                        $("#user_phone_number").text(response.users.phone_number);
                        $("#user_role").text(user_role);
                        var birthDateText = response.users.birth_date ? response.users.birth_date.split(' ')[0] : 'Not Available';
                        $("#user_birthday").text(birthDateText);
                        // $("#user_birthday").text(response.users.birth_date);
                        // $("#user_birthday").text(response.users.birth_date.split(' ')[0]); 
                        $("#user_status").text(user_status);
                        $(".edit-order").modal('show');
                    } else {
                        showAlert(0, "User deactivated");
                    }
                }
            });
        });


            
           //Status Active/ Deactive 
            $(document).on('change', '.switch-active', function() {
                var id = $(this).attr("data-id");
                var _url = "<?php echo e(route('users.active.deactive')); ?>";
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
                            // if (response.status == 1) {
                            //     showAlert(1, "User is activated");
                            //     $('.is_active_' + id).html(
                            //         '<button class="btn btn-success activate" data-id="' + id +
                            //         '"> Active</button>');
                            // } else if (response.status == 0) {
                            //     showAlert(1, "User is deactivated");
                            //     $('.is_active_' + id).html(
                            //         '<button class="btn btn-danger activate" data-id="' + id +
                            //         '"> Deactive</button>');
                            // }
                        } else {
                          //  showAlert(0, "User is deactivate");
                        }
                    }
                });
            });
            
         //delete birthday
         
        $(document).on('click', '.del-btn', function() {    
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
                                        'Action Performed Successfully.')
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

<?php echo $__env->make('layout.master-inner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\wamp\www\realtagportal\resources\views/history/index.blade.php ENDPATH**/ ?>