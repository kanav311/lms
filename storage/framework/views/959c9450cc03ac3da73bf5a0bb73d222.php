<?php $__env->startSection('page-title',''); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php echo $__env->make('admin.partials.crumb',[
    'crumbs'=>[
            route('admin.dashboard')=>__('default.dashboard'),
            route('admin.test.index')=>__lang('tests'),
            '#'=>isset($pageTitle)?$pageTitle:''
        ]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div>
    <div >
        <div class="card">

            <div class="card-body">


                <form method="post" action="<?php echo e(adminUrl(array('controller'=>'test','action'=>$action,'id'=>$id))); ?>">
                    <?php echo csrf_field(); ?>

                <div class="form-group">
                    <?php echo e(formLabel($form->get('name'))); ?>

                    <?php echo e(formElement($form->get('name'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('name'))); ?></p>

                </div>
                <div class="form-group">
                    <?php echo e(formLabel($form->get('description'))); ?>

                    <?php echo e(formElement($form->get('description'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('description'))); ?></p>

                </div>


                <div class="form-group">
                    <?php echo e(formLabel($form->get('enabled'))); ?>

                    <?php echo e(formElement($form->get('enabled'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('enabled'))); ?></p>

                </div>

                <div class="form-group">
                    <?php echo e(formLabel($form->get('passmark'))); ?>

                    <?php echo e(formElement($form->get('passmark'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('passmark'))); ?></p>
                    <p class="help-block"><?php echo e(__lang('test-passmark-help')); ?></p>

                </div>

                <div class="form-group">
                    <?php echo e(formLabel($form->get('minutes'))); ?>

                    <?php echo e(formElement($form->get('minutes'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('minutes'))); ?></p>

                </div>

                <div class="form-group">
                    <?php echo e(formLabel($form->get('allow_multiple'))); ?>

                    <?php echo e(formElement($form->get('allow_multiple'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('allow_multiple'))); ?></p>

                </div>
                <div class="form-group">
                    <input type="hidden" name="private" value="0">
                    <?php echo e(formLabel($form->get('private'))); ?>

                    <?php echo e(formElement($form->get('private'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('private'))); ?></p>

                    <p class="help-block"><?php echo e(__lang('test-private-help')); ?></p>
                </div>

                <div class="form-group">
                    <input type="hidden" name="show_result" value="0">
                    <?php echo e(formLabel($form->get('show_result'))); ?>

                    <?php echo e(formElement($form->get('show_result'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('show_result'))); ?></p>

                    <p class="help-block"><?php echo e(__lang('test-show-result-help')); ?></p>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary"><?php echo e(__lang('save-changes')); ?></button>
                </div>
                 </form>
            </div>
        </div><!--end .box -->
    </div><!--end .col-lg-12 -->
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <script type="text/javascript" src="<?php echo e(asset('client/vendor/ckeditor/ckeditor.js')); ?>"></script>
    <script type="text/javascript">

        CKEDITOR.replace('description', {
            filebrowserBrowseUrl: '<?php echo e(basePath()); ?>/admin/filemanager',
            filebrowserImageBrowseUrl: '<?php echo e(basePath()); ?>/admin/filemanager',
            filebrowserFlashBrowseUrl: '<?php echo e(basePath()); ?>/admin/filemanager'
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\resources\views/admin/test/add.blade.php ENDPATH**/ ?>