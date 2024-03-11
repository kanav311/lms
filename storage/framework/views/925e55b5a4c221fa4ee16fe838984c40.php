<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title><?= __('filemanager') ?></title>
    <base href="<?php echo e(url('/')); ?>" />

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('client/vendor/filemanager/vendor/jquery-ui.css')); ?>">
    <!-- Section JavaScript -->
    <!-- jQuery and jQuery UI (REQUIRED) -->
    <!--[if lt IE 9]>
    <script src="<?php echo e(asset('client/vendor/filemanager/vendor/jquery-1.12.4.min.js')); ?>"></script>
    <![endif]-->
    <!--[if gte IE 9]><!-->
    <script src="<?php echo e(asset('client/vendor/filemanager/vendor/jquery-3.2.1.min.js')); ?>"></script>
    <!--<![endif]-->
    <script src="<?php echo e(asset('client/vendor/filemanager/vendor/jquery-ui.min.js')); ?>"></script>



<?php echo $__env->yieldContent('header'); ?>


</head>
<body>

<?php echo $__env->yieldContent('content'); ?>

<?php echo $__env->yieldContent('footer'); ?>
</body>
</html>
<?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\resources\views/layouts/filemanager.blade.php ENDPATH**/ ?>