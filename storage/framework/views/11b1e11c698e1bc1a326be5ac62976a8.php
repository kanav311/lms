<?php $__env->startSection('pageTitle',$pageTitle); ?>
<?php $__env->startSection('innerTitle',$pageTitle); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php echo $__env->make('admin.partials.crumb',[
    'crumbs'=>[
            route('student.dashboard')=>__lang('dashboard'),
            route('student.test.index')=>__lang('tests'),
            '#'=>$pageTitle
        ]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-7 offset-3">
            <div class="card">

                <div class="card-body">
                    <div class="container">
                        <?php  if($testRow->show_result==1): ?>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-3">
                                <h4><?php echo e(__lang('your-score')); ?></h4>
                                <h1><?php echo e($row->score); ?>%</h1>
                            </div>
                            <div class="col-md-4">
                                <h4><?php echo e(__lang('passmark')); ?></h4>
                                <h1><?php echo e($testRow->passmark); ?>%</h1>
                            </div>
                        </div>

                        <div id="testresult" class="row" style="text-align: center; margin-top: 30px">

                            <?php  if($row->score >= $testRow->passmark ):  ?>
                            <h1 style="color:green"><?php echo e(__lang('you-passed-test')); ?></h1>
                            <?php  else:  ?>
                            <h1 style="color:red"><?php echo e(__lang('you-failed-test')); ?></h1>
                            <?php  endif;  ?>

                        </div>
                        <?php  else:  ?>
                        <div class="row">
                            <h4><?php echo e(__lang('you-completed-test')); ?></h4>
                        </div>

                        <?php  endif;  ?>

                    </div>
                </div>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.student', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\resources\views/student/test/result.blade.php ENDPATH**/ ?>