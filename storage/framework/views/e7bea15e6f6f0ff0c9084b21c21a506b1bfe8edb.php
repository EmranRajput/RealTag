<?php $__env->startSection('title'); ?>
    Rental Agreements
<?php $__env->stopSection(); ?>
<link rel="stylesheet" href="<?php echo e(URL::asset('../build/libs/gridjs/theme/mermaid.min.css')); ?>">
<link rel="stylesheet" href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap2-toggle.min.css">
<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css">-->

<!-- Include bootstrap-datepicker CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

<style>
    .toggle-group{
         height: 35px !important;   
    }
    .toggle{
            width: 63px !important;
            height: 40px !important;
    } 
</style>
<!--<?php $__env->startSection('css'); ?>-->
    
<!--<?php $__env->stopSection(); ?>-->
<?php $__env->startSection('page-title'); ?>
Rental Agreements
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
    <body>
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('content'); ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo e(route('agent.rental.agreements')); ?>" method="GET" class="row" id="filter_form">
                        <!--search filters-->
                        <div class="col-sm-3  mb-4">
                            <label for="first_name">Tenant Account Name</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control select-tenant" id="exampleSelect"  name="tenant_id">
                                        <option value="">Select Tenant</option>
                                        <?php if($tanents): ?>
                                            <?php $__currentLoopData = $tanents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($tenant->id); ?>" <?php if(request('tenant_id') == $tenant->id): ?> selected  <?php endif; ?>> <?php echo e($tenant->name); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
            
                                </div>
                            </div>
                        </div>
                         <div class="col-sm-3 mb-4">
                            <label for="first_name">Landlord Account Name</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control select-landlord" id="exampleSelect" name="landlord_id">
                                        <option value="">Select Landlord</option>
                                         <?php if($landlords): ?>
                                                <?php $__currentLoopData = $landlords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $landlord): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($landlord->id); ?>" <?php if(request('landlord_id') == $landlord->id): ?> selected <?php endif; ?>><?php echo e($landlord->name); ?></option>                            
                                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>      
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                            <div class="col-sm-3 mb-4">
                                <label for="first_name">Rental Address</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="rental_amount form-control" name="address" placeholder="Search Address" value="<?php echo e(request('address')); ?>">
                                    </div>
                                </div>
                            </div>
            
                             <div class="col-sm-3 mb-4">
                                <label for="first_name">Select Date Range</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="date_range" placeholder="Select the dates" class="form-control " name="dates"
                                            value="<?php echo e(request('dates')); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="">
                            
                            <button type="submit" class="btn btn-success  mb-2"> Show on screen</button>
                            <a href="" class="create-new">
                            <a class="btn btn-danger  mb-2" href="<?php echo e(route('agent.rental.agreements')); ?>"> Reset Filter</a>
                            <a href="" class="create-new">
                            <button class="btn btn-primary  mb-2">Export CSV</button></a> 
                            <a href="" class="create-new">
                            <button class="btn btn-info  mb-2"> Export PDF</button></a>
                                        
                         </div>
                         </form>

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

        <!--  Create Large modal example -->
        <div class="modal fade add-new-order" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Create Rental Agreement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frm_create" method="POST" action="<?php echo e(route('agent.rental.agreement.create.update')); ?>"
                            class="cls-crud-simple-save" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row clearfix">
                                <div class="col-sm-6 ">
                                    <label for="first_name">Tenant IC No:<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control select-tenant" id="exampleSelect" name="tenant">
                                                <option value="">Select Tenant</option>
                                                <?php $__currentLoopData = $tanents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tanent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($tanent->id); ?>"><?php echo e($tanent->identity_number); ?>

                                                </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 ">
                                    <label for="first_name">Landlord IC no:<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control select-landlord" id="exampleSelect"
                                                name="landlord">
                                                <option value="">Select Landlord</option>
                                                <?php $__currentLoopData = $landlords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $landlord): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($landlord->id); ?>" ><?php echo e($landlord->identity_number); ?>

                                                </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-3">
                                    <label for="startDate">Start Date :<span class="text-danger">*</span></label>
                                    
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="startDate" value="" class="form-control txtDate_start changeAtrr" placeholder="DD/MM/YYYY"   name="start_date"   required>
                                            <input type="hidden" id="actualStartDate">

                                            <!--<span id="formattedDate1"></span>-->

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-3">
                                    <label for="first_name">End Date :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="endDate" value="" class="form-control txtDate_end changeAtrr" placeholder="DD/MM/YYYY" name="end_date"   required>
                                            <input type="hidden" id="actualEndDate">

                                        </div>
                                        <p class="text-danger" id="dateError"></p>
                                    </div>
                                </div> 
                                
                                <div class="col-sm-6">
                                    <label for="first_name">Duration :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" min="1" class="form-control input_duration"
                                                name="duration" 
                                                disabled>
                                        </div>
                                        <p class="text-danger" id="duration_error"></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="first_name">Rental Amount :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="rental_amount form-control" name="rental_amount"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="first_name">Security Deposit :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="security_deposit form-control"
                                                name="security_deposit"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="first_name">Utility Deposit :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="utility_deposit form-control"
                                                name="utility_deposit"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-3">
                                    <label for="first_name">Address :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="address"
                                                 required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-3">
                                    <label for="first_name">Agreement:<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" id="exampleSelect" name="agreement">
                                                <option value="">Select Agreement</option>
                                                <?php if(!empty($agreementss)): ?>
                                                    <?php $__currentLoopData = $agreementss; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agreement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($agreement->id); ?>"><?php echo e($agreement->title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 mt-3">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label for="first_name">Agent Services :<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <div class="">
                                                    <!--<input type="checkbox" name="agent_service" class="agent_service switch-active" id="switchagent" data-id="" value="1" switch="none" checked="" data-toggle="toggle">-->
                                                    <!--<label for="switchagent" data-on-label="on" data-off-label="off"></label>-->
                                                    <input type="checkbox" name="agent_service" value="1" data-toggle="toggle" data-size="sm" checked>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 ">
                                    <div class="row">
                                        <div class="col-sm-6 mt-3">
                                            <label for="first_name">Guest Tenant :<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-6 mt-3">
                                            <div class="form-group">
                                                <div class="">
                                                    <input type="checkbox" class="guest-tenant" data-toggle="toggle" data-size="sm" name="guest_tenant" value="yes">
                                                    <!--<input type="checkbox" name="guest_tenant" class="switch-active guest-tenant " id="switchaguest" data-id="" value="1" switch="none" checked="" data-toggle="toggle">-->
                                                    <!--<label for="switchaguest" data-on-label="on" data-off-label="off"></label>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 ">
                                    <div class="row">
                                        <div class="col-sm-6 mt-3">
                                            <label for="first_name">Guest Landlord :<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-6 mt-3">
                                            <div class="form-group">
                                                <div class="">
                                                    <!--<input type="checkbox" name="guest_landlord" class=" guest-landlord"  data-id="" data-size="sm" value="yes" data-toggle="toggle">-->
                                                    <!--<label for="switchalandlord" data-on-label="on" data-off-label="off"></label>-->
                                                    <input type="checkbox" class="guest-landlord" data-toggle="toggle" data-size="sm" name="guest_landlord" value="yes">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 create-guest-tenant d-none">
                                    <label for="first_name">Tenant Name :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="tenant_name"
                                                value="<?php echo e(old('tenant_name')); ?>">
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-sm-6 create-guest-tenant d-none">
                                    <label for="first_name">Tenant Email. :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="email" class="form-control" name="tenant_email"
                                                value="<?php echo e(old('tenant_email')); ?>">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 create-guest-tenant d-none">
                                    <label for="first_name">Tenant IC NO. :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="tenant_ic_number"
                                                value="<?php echo e(old('tenant_ic_number')); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 create-guest-landlord d-none">
                                    <label for="first_name">Landlord Email. :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="email" class="form-control" name="landlord_email"
                                                value="<?php echo e(old('landlord_email')); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 create-guest-landlord d-none">
                                    <label for="first_name">Landlord Name :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="landlord_name"
                                                value="<?php echo e(old('landlord_name')); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 create-guest-landlord d-none">
                                    <label for="first_name">Landlord IC NO. :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="landlord_ic_number"
                                                value="<?php echo e(old('landlord_ic_number')); ?>">
                                        </div>
                                    </div>
                                </div>
                                 
                            </div>
                            <div class="row mt-2">
                                    <div class="col-12 text-end">
                                        <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal"><i
                                                class="bx bx-x me-1"></i> Cancel</button>
                                        <button type="submit" class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#success-btn" id="btn-save-event validateButton"><i class="bx bx-check me-1"></i>
                                            Create</button>
                                    </div>
                                </div>
                        </form>
                    </div>


                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
            <!--// show agreement model -->
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
                                         <p><strong>Agreement:</strong> <span id="agreement_temp"></span></p>
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





        <!-- Edit Modal Start-->
<div class="modal fade edit-invoice" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Invioce</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frm" method="POST" action="<?php echo e(route('invoices.create.update')); ?>"
                            class="cls-crud-simple-save" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" id="invoiceID" value="" name="id">
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <label for="first_name">Name :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="name" class="form-control" name="name"
                                                value="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="first_name">Identity Number :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="identity_number" class="form-control"
                                                name="identity_number"
                                                value="<?php echo e(@$getData->identity_number ?? old('identity_number')); ?>"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-3">
                                    <label for="first_name">Service Tax :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" id="service_tax" class="form-control" name="service_tax"
                                                value="<?php echo e(@$getData->service_tax ?? old('service_tax')); ?>" required>
                                        </div>
                                        <p class="text-danger" id="dateError"></p>
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-3">
                                    <label for="first_name">Invoice Type :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control select-landlord" id="invoice_type"
                                                name="invoice_type" required>
                                                <option value="">Select Type</option>
                                                <option <?php if(@$getData->invoice_type == 'Miscellaneous'): ?> selected <?php endif; ?>
                                                    <option value="">Select Type</option>
                                                    <option <?php echo e(@$getData->invoice_type == 'Miscellaneous' ? 'selected' : ''); ?> value="Miscellaneous">Miscellaneous</option>
                                                    <option <?php echo e(@$getData->invoice_type == 'Rental Invoice' ? 'selected' : ''); ?> value="Rental Invoice">Rental Invoice</option>
                                                    <option <?php echo e(@$getData->invoice_type == 'Deposit' ? 'selected' : ''); ?> value="Deposit">Deposit</option>
                                                    <option <?php echo e(@$getData->invoice_type == 'House Maintenance' ? 'selected' : ''); ?> value="House Maintenance">House Maintenance</option>
                                                    <option <?php echo e(@$getData->invoice_type == 'Refund' ? 'selected' : ''); ?> value="Refund">Refund</option>
                                                    <option <?php echo e(@$getData->invoice_type == 'Others' ? 'selected' : ''); ?> value="Others">Others</option>
                                                                                </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 " id="dynamic-rows-container">
                                    <?php if(!empty($item_lists) && is_array($item_lists)): ?>
                                        <?php $__currentLoopData = $item_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="dynamic-row col-sm-12 d-flex">
                                        <div class="col-sm-3">
                                            <label for="first_name">Item :<span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="name" id="items" class="form-control" name="items[]"
                                                        value="<?php echo e(@$list->items ?? old('items')); ?>" required>
                                                </div>
                                                <p class="text-danger" id="dateError"></p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="first_name">Description :<span
                                                    class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="descriptions" class="form-control"
                                                        name="descriptions[]"
                                                        value="<?php echo e(@$list->descriptions ?? old('descriptions')); ?>"
                                                        required>
                                                </div>
                                                <p class="text-danger" id="dateError"></p>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="first_name">Amount :<span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="number" id="amounts" class="form-control"
                                                        name="amounts[]"
                                                        value="<?php echo e(@$list->amounts ?? old('amounts')); ?>" required>
                                                </div>
                                                <p class="text-danger" id="dateError"></p>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <button type="button" class="btn bg-danger btn-remove-row">-</button>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                    <div class="dynamic-row col-sm-12 d-flex">
                                        <div class="col-sm-3">
                                            <label for="first_name">Item :<span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="name" id="endDate" class="form-control" name="items[]"
                                                        value="<?php echo e(@$list->items ?? old('items')); ?>" required>
                                                </div>
                                                <p class="text-danger" id="dateError"></p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="first_name">Description :<span
                                                    class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="endDate" class="form-control"
                                                        name="descriptions[]"
                                                        value="<?php echo e(@$list->descriptions ?? old('descriptions')); ?>"
                                                        required>
                                                </div>
                                                <p class="text-danger" id="dateError"></p>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="first_name">Amount :<span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="number" id="endDate" class="form-control"
                                                        name="amounts[]"
                                                        value="<?php echo e(@$list->amounts ?? old('amounts')); ?>" required>
                                                </div>
                                                <p class="text-danger" id="dateError"></p>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <button type="button" class="btn bg-danger btn-remove-row" style="color: #fff;">-</button>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <div class="col-sm-12 mb-2 ">
                                    <button type="button" class="btn bg-primary" id="btn-add-row" style="color: #fff;">+</button>
                                </div>
                                <div class="col-sm-12">
                                    <button id="sumit-btn" type="submit"
                                        class="btn btn-success ">Update</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('scripts'); ?>
      <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">-->

        <script src="<?php echo e(URL::asset('/build/libs/gridjs/gridjs.umd.js')); ?>"></script>
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap2-toggle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- Include bootstrap-datepicker JS -->
  <!--<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>-->
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-daterangepicker@3.0.5/daterangepicker.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-daterangepicker@3.0.5/daterangepicker.css">
        <script>
    


                $(document).ready(function(){
                    new gridjs.Grid({
                        columns: [
                            {
                                name: 'Landlord ',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                             {
                                name: 'Tenant',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                            {
                                name: 'Address',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                             {
                                name: 'Rental Amount',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                            {
                                name: 'Start Date',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                             {
                                name: 'End Date',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                             {
                                name: 'Security Deposit',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                             {
                                name: 'Utility Deposit',
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
                                    <?php foreach($agreements as $agreement){ ?>
                                <?php
                                $editButton = (auth()->guard(userGuard())->user()->role == 1) ? '<button class="btn deleteButton pajama"><a href="' . route('agent.rental.agreement.edit', $agreement->id) . '"><i class="fas fa-edit p-2"></i></a></button>' : '';
                                if ($agreement->invoiceID != "" && $agreement->invoiceStatus == 0) {
                                    $invoiceButton = '<button type="button" class=" btn invoice deleteButton einvoice" data-einvoice_url="'.route('invoices.edit.create', $agreement->invoiceID).'"><i class="fa fa-edit"></i></button>';
                                } elseif ($agreement->invoiceStatus != 0) {
                                    $invoiceButton = '<button class=" btn invoice deleteButton"><a href="' . route('invoices.index') . '"><i class="fa fa-list"></i></a></button>';
                                } else {
                                    $invoiceButton = '<button class=" btn invoice deleteButton"><a href="' . route('agent.rental.agreement.createinvoice', $agreement->id) . '"><i class="fa fa-plus"></i></a></button>';
                                }
                                $viewButtton='<button title="View Profile" class=" btn  deleteButton  view_agreemet" data-id="' .$agreement->id . '"><i class="fas fa-eye"></i></button>';
                            
                                $deleteButton = '<button class=" btn deleteButton deleteButtons" data-id="' . $agreement->id . '"><i class="fas fa-trash text-danger"></i></button>';
                                $startDate = date('d/m/Y', strtotime($agreement->start_date));
                                $endDate = date('d/m/Y', strtotime($agreement->end_date));

                                ?>
                                    
                                        ['<?=$agreement->landlord->name ?? '--';?>','<?=$agreement->tenant->name ?? '--';?>','<?=$agreement->address;?>','<?=$agreement->rental_amount;?>','<?=$startDate;?>','<?=$endDate;?>','<?=$agreement->security_deposit;?>','<?=$agreement->utility_deposit;?>','<input type="checkbox" class="switch-active" id="switch<?=$agreement->id?>" data-id="<?=$agreement->id?>" value="<?=$agreement->status;?>" switch="none" <?=$agreement->status==1 ? "checked" : "" ;?> /><label for="switch<?=$agreement->id?>"  data-on-label="on" data-off-label="off"></label>','<?=$editButton . $invoiceButton .$viewButtton. $deleteButton;?>'],<?php } ?>
                                    
                                 ]
                    }).render(document.getElementById("table-ecommerce-orders"));
                
                
                })
                    
                 $(document).ready(function() {
                // Attempt to change the type to 'date' for an input with a specific ID
                // var $startDateInput = $('#startDate, #endDate');
                // $startDateInput.attr('type', 'date');
                $(".txtDate_start").datepicker({
                    format: 'dd/mm/yyyy',
                    startDate:new Date()
                });
                $('.txtDate_start, .txtDate_end').each(function() {
                    if ($(this).type !== 'date') { // Check if browser changed the type to 'date'
                        var $input = $(this); // Cache a reference to the input field
                        // alert($input.val());
                        $input.datepicker({
                            startDate:new Date(),
                            format: 'dd/mm/yyyy', // Your desired format
                            changeDate:function(dateText, inst) {
                                    $input.val(val(inst.selectedYear + '-' + (inst.selectedMonth + 1) + '-' + inst.selectedDay));
                            }
                        })
                    }
                });
              
                
                
            });

                // form submit alert
                $('#frm_create').submit(function(e) {
                    e.preventDefault(); 
                    var formAction = $(this).attr('action');
                
                    $.ajax({
                        type: "POST",
                        url: formAction,
                        data: $(this).serialize(),
                        success: function(response) {
                            // Show SweetAlert confirmation
                            showAlert(true, 'Agreement Created Successfully.');
                                setTimeout(function() {
                                window.location.reload();
                            }, 2000);

                        },
                        error: function(error) {
                            showAlert(false, 'Failed to create Agreement.');
                            console.error(error);
                        }
                    });
                });
                
                $(document).ready(function() {

                        $(document).on('click','.einvoice',function(){
                                var router = $(this).data('einvoice_url');
                                $.ajax({
                                    type: "GET",
                                    url: router,
                                    data: {},
                                    success: function(response) {
                                        if (response.success==1) {
                                            const dataObject = JSON.parse(response.data);
                                            
                                            // alert(dataObject.getData.id);
                                            console.log("asasas",response.data);
                                            $("#invoiceID").val(dataObject.getData.id);
                                            $("#name").val(dataObject.getData.name);
                                            $("#identity_number").val(dataObject.getData.identity_number);
                                            $("#service_tax").val(dataObject.getData.service_tax);
                                            $("#invoice_type").val(dataObject.getData.invoice_type);
                                            $("#items").val(dataObject.getData.items);
                                            $("#descriptions").val(dataObject.getData.descriptions);
                                            $("#amounts").val(dataObject.getData.amounts);

                                            $(".edit-invoice").modal("show");
                                            //showAlert(1, response.message); // Assuming response.success is a boolean and response.message contains the success message
                                        } else {
                                            $(".error-modal").show("modal"); // Assuming response.error contains the error message
                                        }
                                        // location.reload(); // Consider reloading only parts of the page or updating the UI without a full reload for better UX
                                    },
                                    error: function(xhr, status, error) {
                                        // Handle potential errors here
                                        console.error("AJAX error:", status, error);
                                }
                            });
                        });
                        $('.guest-tenant').bootstrapToggle();
                        $('.guest-landlord').bootstrapToggle();
                        $('.guest-tenant').change(function() {
                            if ($(this).prop('checked')) {
                    
                                $('.create-guest-tenant').removeClass('d-none');
                                $('.select-tenant').prop('disabled', true);
                            } else {
                                $('.create-guest-tenant').addClass('d-none');
                                $('.select-tenant').prop('disabled', false);
                    
                            }
                        });
                    
                        $('.guest-landlord').change(function() {
                            if ($(this).prop('checked')) {
                                $('.create-guest-landlord').removeClass('d-none');
                                $('.select-landlord').prop('disabled', true);
                    
                            } else {
                                $('.create-guest-landlord').addClass('d-none');
                                $('.select-landlord').prop('disabled', false);
                    
                            }
                        });
                    
                        $('#startDate, #endDate').on('change', function() {
                            var startDate = $('#startDate').val();
                            var endDate = $('#endDate').val();
                            
                            if (startDate && endDate) {
                                if (startDate > endDate) {
                                    $('#sumit-btn').prop('disabled', true);
                                    $('#dateError').text('End Date must be greater than Start Date');
                                } else {
                                    $('#sumit-btn').prop('disabled', false);
                                    $('#dateError').text('');
                                }
                            }
                        });
                    
                    $('#endDate').on('change', function() {
                        //alert($('#startDate').val());
                        var startDate = moment($('#startDate').val(),'DD/MM/YYYY');
                        var endDate = moment($('#endDate').val(),'DD/MM/YYYY');
                        
                        // Check if both startDate and endDate are valid Moment.js objects
                        if (startDate.isValid() && endDate.isValid()) {
                       
                            var durationInMonths = moment(endDate).diff(moment(startDate), 'months');
                            var final;
                            if (durationInMonths > 11) {
                                var years = Math.floor(durationInMonths / 12);
                                var months = durationInMonths % 12;
                                final = months + ' Months, ' + years + ' Years';
                            } else {
                                final = durationInMonths + ' Months';
                            }
                    
                            console.log(final, 'durationInMonths');
                    
                            if (final) {
                                $('.input_duration').val(final);
                                $('#duration_error').text('');
                            } else {
                                $('.input_duration').val('');
                                $('#duration_error').text('Please enter valid start and end dates.');
                            }
                        } else {
                            $('#duration_error').text('Please enter valid start and end dates.');
                        }
                    });
                    
                    $('.rental_amount').on('input', function() {
                        var inputValue = $(this).val();
                        if (!isNaN(inputValue) && inputValue !== "") {
                            var doubledValue = inputValue * 2;
                            var halfValue = inputValue * .5;
                            $('.security_deposit').val(doubledValue);
                            $('.utility_deposit').val(halfValue);
                        } else {
                            $('.security_deposit').val('');
                            $('.utility_deposit').val('');
                        }
                    });
                });
        </script>
<!--date range picker -->

<!--<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>-->

<!--<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>-->

<!-- Initialize the date range picker -->
<script>
    $(document).ready(function () {
        $('#date_range').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('#date_range').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ',' + picker.endDate.format('YYYY-MM-DD'));
            $("#filter_form").submit();
        });

        $('#date_range').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
        });
        
        $(document).on('click', '#agrement1_id', function() {
            var _url = "<?php echo e(route('agent.rental.agreement.parse')); ?>";
            var tenant_name = document.getElementById("tenant_name").textContent;
            var tenant_ic_no = document.getElementById("tenant_ic_no").textContent;
            var landlord_name = document.getElementById("landlord_name").textContent;
            var landlord_ic_no = document.getElementById("landlord_ic_no").textContent;
            var agent_name = document.getElementById("agent_name").textContent;
            var rental_address = document.getElementById("rental_address").textContent;
            var rental_startdate = document.getElementById("rental_startdate").textContent;
            var rental_enddate = document.getElementById("rental_enddate").textContent;
            var rental_agent_services = document.getElementById("rental_agent_services").textContent;
            var rental_amount = document.getElementById("rental_amount").textContent;
            var rental_security_deposit = document.getElementById("rental_security_deposit").textContent;
            var rental_utility_deposit = document.getElementById("rental_utility_deposit").textContent;
            var rental_duration = document.getElementById("rental_duration").textContent;
            var rental_status = document.getElementById("rental_status").textContent;
            var agrement_id = document.getElementById("agrement_id").value;
            var jsonObject = {
                    "tenant_name": tenant_name,
                    "tenant_ic_no": tenant_ic_no,
                    "landlord_name": landlord_name,
                    "landlord_ic_no": landlord_ic_no,
                    "agent_name": agent_name,
                    "rental_address": rental_address,
                    "rental_start_date": rental_startdate,
                    "rental_end_date": rental_enddate,
                    "rental_agent_services": rental_agent_services,
                    "rental_amount": rental_amount,
                    "rental_security_deposit": rental_security_deposit,
                    "rental_utility_deposit": rental_utility_deposit,
                    "rental_duration": rental_duration,
                    "rental_status": rental_status,
                    "agrement_id": agrement_id
                };
            $.ajax({
                type: "POST",
                url: _url,
                data: jsonObject,
                 xhrFields: {
                    responseType: 'blob' // Important for handling binary data
                },
            success: function(response) {
                    var blob = new Blob([response], { type: 'application/pdf' });
        
                    // Create a temporary URL for the blob
                    var blobUrl = window.URL.createObjectURL(blob);
        
                    // Open the URL in a new tab or window
                    window.open(blobUrl);
        
                    // Remove the temporary URL
                    window.URL.revokeObjectURL(blobUrl);
                }
    });
});
    });
</script>
<script>
            //show agreement
            $(document).on('click', '.view_agreemet', function() {
            var id = $(this).attr("data-id");
            // Assuming '_url' is correctly passed from the server to the client, replace it with a valid URL if necessary
            var _url = "<?php echo e(route('agent.rental.agreement.show')); ?>"; // Example path, replace with your actual path
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
                var tenant = response.data.tenant[0];                    // Access the first tenant if it exists
                // var = 
                if(response.data.agreement.status!=1){
                    var sstatus = "Deactivated";   
                }else{
                    var sstatus = "Active";
                }
                if(response.data.agreement.agent_service!=1){
                    var dstatus = "No";   
                }else{
                    var dstatus = "Yes";
                }
                 function formatDate(dateString) {                        //change formate dd/mm/yyyy
                var dateParts = dateString.split('-');
                 return dateParts[2] + '/' + dateParts[1] + '/' + dateParts[0];
                }
                $("#tenant_name").text(tenant ? tenant.name : '');
                $("#tenant_ic_no").text(tenant ? tenant.ic_number : '');
                $("#landlord_name").text(response.data.landlord[0].name);
                $("#landlord_ic_no").text(response.data.landlord[0].ic_number);
                $("#agent_name").text(response.data.agent[0].name);
                $("#agreement_temp").text(response.data.agreementTemp[0].title);
                $("#rental_address").text(response.data.agreement.address);
                $("#rental_startdate").text(formatDate(response.data.agreement.start_date));
                $("#rental_enddate").text(formatDate(response.data.agreement.end_date));
                $("#rental_agent_services").text(dstatus);
                $("#rental_amount").text("$"+response.data.agreement.rental_amount);
                $("#rental_security_deposit").text("$"+response.data.agreement.security_deposit);
                $("#rental_utility_deposit").text("$"+response.data.agreement.utility_deposit);
                $("#rental_duration").text(response.data.agreement.duration);
                $("#rental_status").text(sstatus);
                $("#agrement_id").val(response.data.agreement.agreement_id);
                $(".edit-order").modal('show');
                    } else {
                   showAlert(0, "Rental Agreement is deactivate");
                    }
                }
            });
        });

            
                 function showAlert(status, message) {
                    Swal.fire({
                        icon: status ? 'success' : 'error',
                        text: message,
                        timer: 1500,  // Set the duration in milliseconds (1 second)
                        showConfirmButton: false
                    });
                }
//status active/deactive......................

            $(document).on('change', '.switch-active', function() {
                var id = $(this).attr("data-id");
                var _url = "<?php echo e(route('agent.rental.agreement.active.deactive')); ?>";
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
                                showAlert(1, "Agreement is activated");
                                $('.is_active_' + id).html(
                                    '<button class="btn btn-success activate" data-id="' + id +
                                    '"> Active</button>');
                            } else if (response.status == 0) {
                                showAlert('', " Agreement is deactivated");
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
            
         //delete Tenant Template
         
        $(document).on('click', '.deleteButtons', function() {    
            // $(".del-btn").click(function() {
                var del_id = $(this).attr("data-id");
                var _url = "<?php echo e(route('agent.rental.agreement.delete')); ?>";
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

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\wamp\www\realtagportal\resources\views/rentalAgreememt/index.blade.php ENDPATH**/ ?>