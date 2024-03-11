<?php $__env->startSection('page-title',''); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php echo $__env->make('admin.partials.crumb',[
    'crumbs'=>[
            route('admin.dashboard')=>__('default.dashboard'),
            '#'=>isset($pageTitle)?$pageTitle:''
        ]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="card">
<div class="card-body">
    <div class="row">



        <div class="col-md-12">
            <table class="table table-striped">

                <tr>
                    <th><?php echo e(__lang('total-videos')); ?>:</th>
                    <td><?php echo e($total); ?></td>
                </tr>
                <tr>
                    <th><?php echo e(__lang('disk-usage')); ?>:</th>
                    <td><?php echo e($diskUsage); ?></td>
                </tr>
            </table>
        </div>

    </div>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\krish\Videos\base_file_aiipl\resources\views/admin/video/disk.blade.php ENDPATH**/ ?>