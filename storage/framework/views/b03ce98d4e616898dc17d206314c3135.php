<?php $__env->startSection('pageTitle',__('default.dashboard-theme')); ?>

<?php $__env->startSection('innerTitle'); ?>
    <?php echo app('translator')->get('default.dashboard-theme'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <?php echo $__env->make('admin.partials.crumb',[
    'crumbs'=>[
            route('admin.dashboard')=>__('default.dashboard'),
            '#'=>__('default.dashboard-theme')
        ]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st">

                    <div  >
                        <div  >



                            <form class="form-inline_" method="post" action="<?php echo e(route('admin.save-dashboard-theme')); ?>">
                                <?php echo csrf_field(); ?>
                                <label for="config_language"><?php echo app('translator')->get('default.color'); ?></label>
                                <div class="form-group input-group myColorPicker">

                                    <input name="color" value="<?php echo e(old('color',$color)); ?>" type="text" class="form-control colorpicker-full">

                                </div>
                                <button type="submit" class="btn btn-lg btn-block btn-primary"><?php echo app('translator')->get('default.save'); ?></button>
                            </form>


                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('header'); ?>

    <link href="<?php echo e(asset('client/vendor/jquery-ui-1.11.4/jquery-ui.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('client/vendor/colorpicker/jquery.colorpicker.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <script src="<?php echo e(asset('client/vendor/jquery-ui-1.11.4/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('client/vendor/colorpicker/jquery.colorpicker.js')); ?>"></script>



    <script>
        "use strict";
        $(document).ready(function(){


            $('.colorpicker-full').colorpicker({
                parts:          'full',
                showOn:         'both',
                buttonColorize: true,
                showNoneButton: true,
                buttonImage : '<?php echo e(asset('client/vendor/colorpicker/images/ui-colorpicker.png')); ?>'
            });

        });
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\resources\views/admin/setting/dashboard.blade.php ENDPATH**/ ?>