
<?php $__env->startSection('title'); ?>
    Users
<?php $__env->stopSection(); ?>
<link rel="stylesheet" href="<?php echo e(URL::asset('../build/libs/gridjs/theme/mermaid.min.css')); ?>">
<!--<?php $__env->startSection('css'); ?>-->
    
<!--<?php $__env->stopSection(); ?>-->
<?php $__env->startSection('page-title'); ?>
    Users
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
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="dropdown">
                                            <button class="btn btn-success dropdown-toggle" type="button" id="roleDropdownButton" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-search"></i>
                                                Search User Role <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="roleDropdownButton">
                                                <li><a class="dropdown-item searchRole" href="#" data-value="#">Show All Users</a></li>
                                                <li><a class="dropdown-item searchRole" href="#" data-value="1">Admin</a></li>
                                                <li><a class="dropdown-item searchRole" href="#" data-value="2">Agent</a></li>
                                                <li><a class="dropdown-item searchRole" href="#" data-value="3">Landlord</a></li>
                                                <li><a class="dropdown-item searchRole" href="#" data-value="4">Tenant</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
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
        
<!-- view Modal Start-->
<div class="modal fade edit-order" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">User Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                          <div class="row">
                            <!-- Left Side Content -->
                            <div class="col-md-6">
                                
                            <img class="rounded-circle shadow-right" id="profile"  src="" alt="" style="width: 100px; height: 100px; margin-bottom: 15px;">
                             <p><strong>Name:</strong><span id="user_name"></span></p>
                             <p><strong>Email:</strong><span id="user_email"></span></p>
                
                              </div>
                              <div class="col-md-6">
                              <p><strong>Identity Number:</strong><span id="user_id_number"></span></p>
                              <p><strong>Phone Number:</strong><span id="user_phone_number"></span></p>
                              <p><strong>Role:</strong> <span id="user_role"></span></p>
                              <p><strong>Birthday:</strong><span id="user_birthday"></span></p>
                              <p><strong>Status:</strong><span id="user_status"></span></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                name: 'Name',
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
                                name: 'IC /Passport Number',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                             {
                                name: 'Phone Number',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                                                         {
                                name: 'Role',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                            {
                                name: 'Status',
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
                          }
                        ],
                      pagination: {
                        limit: 7
                      },
                      sort: true,
                      search: true,
                         data : [ 
                                      <?php foreach($users as $user) {
                                        switch ($user->role) {
                                            case 1:
                                                $roleName = 'Admin';
                                                break;
                                            case 2:
                                                $roleName = 'Agent';
                                                break;
                                            case 3:
                                                $roleName = 'Landlord';
                                                break;
                                            case 4:
                                                $roleName = 'Tanent';
                                                break;
                                            // Add more cases as needed for other roles
                                        }
                                    ?>
                                        ['<?=$user->name;?>','<?=$user->email ?? '--';?>','<?=$user->identity_number ?? '--';?>','<?=$user->phone_number ?? '--';?>','<?=$roleName;?>','<input type="checkbox" class="switch-active1" id="switch<?=$user->id?>" data-id="<?=$user->id?>" value="<?=$user->is_active;?>" switch="none" <?=$user->is_active==1 ? "checked" : "" ;?> /><label for="switch<?=$user->id?>"  data-on-label="on" data-off-label="off"></label>','<button title="View Profile" class="btn btn-sm btn-success edit-birthday" data-id="<?=$user->id?>"><i class="mdi mdi-eye font-size-18"></i></button>'],<?php } ?>
                                    
                                ]
                    }).render(document.getElementById("table-ecommerce-orders"));
                
                
                })
                
        </script>
<script>
//search role by dropdown
 var dropdownItems = document.querySelectorAll('.searchRole');
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

//
    // Function to show a SweetAlert message
    function showAlert(status, message) {
        Swal.fire({
            icon: status ? 'success' : 'error',
            text: message,
            timer: 2000,  // Set the duration in milliseconds (1 second)
            showConfirmButton: false
        });
    }

    // Event listener for switch state change
    $(document).on('change', '.switch-active1', function () {
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
            success: function (response) {
                if (response.success) {
                    if (response.status == 1) {
                        showAlert(1, "User is activated");
                        $('.is_active_' + id).html(
                            '<button class="btn btn-success activate" data-id="' + id +
                            '"> Active</button>');
                    } else if (response.status == 0) {
                        showAlert(1, "User is deactivated");
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




//end

            
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
                            if (response.status == 1) {
                                showAlert(1, "Message is activated");
                                $('.is_active_' + id).html(
                                    '<button class="btn btn-success activate" data-id="' + id +
                                    '"> Active</button>');
                            } else if (response.status == 0) {
                                showAlert('', "Message is deactivated");
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

<?php echo $__env->make('layout.master-inner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\wamp\www\realtagportal\resources\views/users/index.blade.php ENDPATH**/ ?>