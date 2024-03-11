<?php $__env->startSection('pageTitle',$pageTitle); ?>
<?php $__env->startSection('innerTitle',$pageTitle); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php echo $__env->make('admin.partials.crumb',[
    'crumbs'=>[
            route('student.dashboard')=>__lang('dashboard'),
            '#'=>$pageTitle
        ]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



<!--breadcrumb-section ends-->
<!--container starts-->
<div class="card"   >
    <!--primary starts-->

    <div class="card-body">

        <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>

                <th><?php echo e(__lang('Test')); ?></th>
                <th><?php echo e(__lang('Questions')); ?></th>
                <th><?php echo e(__lang('Minutes Allowed')); ?></th>
                <th><?php echo e(__lang('multiple-attempts-allowed')); ?></th>
                <th><?php echo e(__lang('passmark')); ?></th>
                <th  ><?php echo e(__lang('Actions')); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php  foreach($paginator as $row):  ?>
                <tr>
                    <td><?php echo e($row->name); ?></td>
                    <td><?php echo e($questionTable->getTotalQuestions($row->test_id)); ?></td>
                    <td><?php echo e(empty($row->minutes)?__lang('Unlimited'):$row->minutes); ?></td>
                    <td><?php echo e(boolToString($row->allow_multiple)); ?></td>
                    <td><?php echo e(($row->passmark > 0)? $row->passmark.'%':__lang('Ungraded')); ?></td>
                    <td >
                    <?php  if(!$studentTest->hasTest($row->test_id,$id) || !empty($row->allow_multiple)):  ?>
                        <a href="<?php echo e(route('student.test.taketest',array('id'=>$row->test_id))); ?>" class="btn btn-primary " ><i class="fa fa-play"></i> <?php echo e(__lang('Take Test')); ?></a>
                    <?php  endif;  ?>

                        <?php  if($studentTest->hasTest($row->test_id,$id) && $row->show_result==1):  ?>
                            <a href="<?php echo e(route('student.test.testresults',array( 'id'=>$row->test_id))); ?>" class="btn btn-success " ><i class="fa fa-list-ul"></i> <?php echo e(__lang('Your Results')); ?></a>
                        <?php  endif;  ?>

                    </td>

                </tr>
            <?php  endforeach;  ?>

            </tbody>
        </table>
</div>
        <?php
        // add at the end of the file after the table
        echo paginationControl(
        // the paginator object
            $paginator,
            // the scrolling style
            'sliding',
            // the partial to use to render the control
            null,
            // the route to link to when a user clicks a control link
            route('student.test.index')
        );
         ?>
    </div>


</div>

<!--container ends-->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.student', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\resources\views/student/test/index.blade.php ENDPATH**/ ?>