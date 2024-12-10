
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card-top"></div>
    <div class="card">
        <h1 class="title"><span><?php echo siteName(); ?></span>Error 404 <div class="msg">Page not found</div></h1>
        <div class="body text-center">
            <div> <a class="btn btn-raised  waves-effect <?php echo getButtonClass(); ?>" href="<?php echo route('app.login'); ?>">GO TO LOGIN</a> </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layout.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\wamp\www\realtagportal\resources\views/errors/404.blade.php ENDPATH**/ ?>