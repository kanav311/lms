<?php $__env->startSection('page-title',''); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php echo $__env->make('admin.partials.crumb',[
    'crumbs'=>$customCrumbs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<form class="form" action="<?php echo e(selfURL()); ?>" method="post">
<?php echo csrf_field(); ?>
    <div class="form-group">
        <?php echo e(formLabel($form->get('course_id'))); ?>

        <?php echo e(formElement($form->get('course_id'))); ?>

        <p class="help-block"><?php echo e(formElementErrors($form->get('course_id'))); ?></p>
    </div>


    <div class="form-group">
        <?php echo e(formLabel($form->get('opening_date'))); ?>

        <?php echo e(formElement($form->get('opening_date'))); ?>

        <p class="help-block"><?php echo e(formElementErrors($form->get('opening_date'))); ?></p>
    </div>



    <div class="form-group">
        <?php echo e(formLabel($form->get('closing_date'))); ?>

        <?php echo e(formElement($form->get('closing_date'))); ?>

        <p class="help-block"><?php echo e(formElementErrors($form->get('closing_date'))); ?></p>
    </div>




    <div class="form-footer">
        <button type="submit" class="btn btn-primary"><?php echo e(__lang('save')); ?></button>
    </div>
</form>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('client/vendor/pickadate/themes/default.date.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/vendor/pickadate/themes/default.time.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/vendor/pickadate/themes/default.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script type="text/javascript" src="<?php echo e(basePath()); ?>/client/vendor/pickadate/picker.js"></script>
    <script type="text/javascript" src="<?php echo e(basePath()); ?>/client/vendor/pickadate/picker.date.js"></script>
    <script type="text/javascript" src="<?php echo e(basePath()); ?>/client/vendor/pickadate/picker.time.js"></script>
    <script type="text/javascript" src="<?php echo e(basePath()); ?>/client/vendor/pickadate/legacy.js"></script>
    <script>
        $(function(){
            $('.date').pickadate({
                format: 'yyyy-mm-dd'
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\resources\views/admin/test/addsession.blade.php ENDPATH**/ ?>