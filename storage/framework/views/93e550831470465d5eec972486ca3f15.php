
<table class="table table-stripped">
    <thead>
    <tr>
        <th><?php echo e(__lang('question')); ?></th>
        <th><?php echo e(__lang('answer')); ?></th>
        <th><?php echo e(__lang('correct')); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($rowset as $row):  ?>
    <tr>
        <td><?php echo clean($row->question); ?></td>
        <td><?php echo e($row->option); ?></td>
        <td><?php echo e(boolToString($row->is_correct)); ?></td>
    </tr>
    <?php endforeach;  ?>
    </tbody>

</table>
<?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\resources\views/admin/test/testresult.blade.php ENDPATH**/ ?>