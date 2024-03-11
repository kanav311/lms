
<form class="form" method="post" action="<?php echo e(adminUrl(array('controller'=>'student','action'=>'enroll','id'=>$id))); ?>">
  <?php echo csrf_field(); ?>
    <h5><?php echo e(__lang('Enroll')); ?> <?php echo e($student->name.' '.$student->last_name); ?></h5>
    <div style="padding-bottom: 10px">
        <?php echo e(formElement($select)); ?>

    </div>
    <button class="btn btn-primary" type="submit"><?php echo e(__lang('enroll')); ?></button>
</form>

<?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\resources\views/admin/student/enroll.blade.php ENDPATH**/ ?>