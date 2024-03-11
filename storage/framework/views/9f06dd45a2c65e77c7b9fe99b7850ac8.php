<?php if($lecture): ?>
    <div>
        <p class="lead">
            <?php echo e(__lang('Lecture')); ?>: <?php echo e($lecture->title); ?>

        </p>
    </div>
<?php endif; ?>
<!--breadcrumb-section ends-->
<!--container starts-->
<div class="card">
    <!--primary starts-->

    <div class="card-body">
        <div class="mb-2">
            <a target="<?php echo e(@$target); ?>" class="btn btn-primary" href="<?php echo e(route('student.forum.addtopic',['id'=>$id])); ?>"><i class="fa fa-plus"></i> <?php echo e(__lang('Add Topic')); ?></a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th><?php echo e(__lang('Topic')); ?></th>
                    <th><?php echo e(__lang('Created By')); ?></th>
                    <th><?php echo e(__lang('Added On')); ?></th>
                    <th ><?php echo e(__lang('Replies')); ?></th>
                    <th><?php echo e(__lang('Last Reply')); ?></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php  foreach($topics as $row):  ?>

                <tr>
                    <td><?php echo e($row->title); ?></td>
                    <td>
                        <?php echo e($row->user->name); ?>

                    </td>
                    <td><?php echo e(showDate('d/M/Y',$row->created_at)); ?></td>
                    <td><?php echo e(($row->forumPosts->count()-1)); ?></td>
                    <td><?php  if($row->forumPosts->count()-1 > 0): ?>
                        <?php echo e(showDate('D, d M Y g:i a',$row->forumPosts()->orderBy('id','desc')->first()->created_at)); ?>

                        <?php  endif;  ?>
                    </td>
                    <td class="text-right">
                        <a  target="<?php echo e(@$target); ?>"  class="btn btn-primary" href="<?php echo e(route('student.forum.topic',['id'=>$row->id])); ?>"><?php echo e(__lang('View')); ?></a>

                        <?php if(\Illuminate\Support\Facades\Auth::user()->id==$row->user_id): ?>
                            <a onclick="return confirm('Are you sure you want to delete this topic and all its posts?')" class="btn btn-danger" href="<?php echo e(route('student.forum.deletetopic',['id'=>$row->id])); ?>"><?php echo e(__lang('Delete Topic')); ?></a>
                        <?php endif; ?>
                    </td>
                </tr>

                <?php  endforeach;  ?>

                </tbody>
            </table>
        </div>
        <?php
            // add at the end of the file after the table
            echo $topics->links();
        ?>
    </div>


</div>

<!--container ends-->
<?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\resources\views/student/forum/topics-content.blade.php ENDPATH**/ ?>