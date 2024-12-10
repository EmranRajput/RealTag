<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8" />
    <title> <?php echo $__env->yieldContent('title'); ?> | RealTeg</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo e(URL::asset('../build/images/favicon.ico')); ?>">

    
    <link href="<?php echo e(URL::asset('../build/css/bootstrap.min.css')); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(URL::asset('../build/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(URL::asset('../build/css/app.min.css')); ?>" id="app-style" rel="stylesheet" type="text/css" />
    
</head>

<?php echo $__env->yieldContent('body'); ?>

<!-- Begin page -->
<div id="layout-wrapper">
    <!-- topbar -->
    <?php echo $__env->make('layout.topbar1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- sidebar components -->
    <?php echo $__env->make('layout.sidebar1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layout.horizontal1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!-- footer -->
        <?php echo $__env->make('layout.footer1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

<!-- customizer -->
<!--<?php echo $__env->make('layout.right-sidebar1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>-->

<!-- vendor-scripts -->
<?php echo $__env->make('layout.vendor-scripts1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>

</html>
<?php /**PATH E:\wamp\www\realtagportal\resources\views/layout/master-inner.blade.php ENDPATH**/ ?>