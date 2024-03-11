<?php $__env->startSection('page-title',''); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php echo $__env->make('admin.partials.crumb',[
    'crumbs'=>[
            route('admin.dashboard')=>__('default.dashboard'),
            '#'=>isset($pageTitle)?$pageTitle:''
        ]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div>
    <div >
        <div class="card">
            <div class="card-header">
                <header></header>
                <a class="btn btn-primary float-right" href="<?php echo e(adminUrl(array('controller'=>'certificate','action'=>'add'))); ?>"><i class="fa fa-plus"></i> <?php echo e(__lang('Create Certificate')); ?></a>



            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo e(__lang('name')); ?></th>
                        <th><?php echo e(__lang('session-course')); ?></th>
                        <th><?php echo e(__lang('enabled')); ?></th>
                        <th><?php echo e(__lang('price')); ?></th>
                        <?php if(GLOBAL_ACCESS): ?>
                        <th><?php echo e(__lang('created-by')); ?></th>
                        <?php endif;  ?>
                        <th   ><?php echo e(__lang('actions')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($paginator as $row):  ?>
                        <tr>
                            <td><span class="label label-success"><?php echo e($row->id); ?></span></td>
                            <td><?php echo e($row->name); ?></td>
                            <td><?php echo e($row->course_name); ?></td>
                            <td><?php echo e(boolToString($row->enabled)); ?></td>
                            <td>
                                 <?php echo e($row->payment_required==1?price($row->price):__lang('free')); ?>

                            </td>
                            <?php if(GLOBAL_ACCESS): ?>
                                <td><?php echo e(adminName($row->admin_id)); ?></td>
                            <?php endif;  ?>

                            <td  >
                                 <div class="button-group dropup">
                                                       <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      <i class="fa fa-cogs"></i>   <?php echo e(__lang('actions')); ?>

                                                       </button>
                                                       <div class="dropdown-menu wide-btn">

                                                           <a href="<?php echo e(adminUrl(array('controller'=>'certificate','action'=>'edit','id'=>$row->id))); ?>" class="dropdown-item"  ><i class="fa fa-edit"></i> <?php echo e(__lang('edit')); ?></a>
                                                           <a onclick="return confirm('<?php echo e(__lang('delete-confirm')); ?>')" href="<?php echo e(adminUrl(array('controller'=>'certificate','action'=>'delete','id'=>$row->id))); ?>"   class="dropdown-item"  ><i class="fa fa-trash"></i> <?php echo e(__lang('delete')); ?></a>
                                                           <a    class="dropdown-item" href="<?php echo e(adminUrl(array('controller'=>'certificate','action'=>'duplicate','id'=>$row->id))); ?>"  ><i class="fa fa-copy"></i> <?php echo e(__lang('duplicate')); ?></a>
                                                           <a    class="dropdown-item" href="<?php echo e(adminUrl(array('controller'=>'certificate','action'=>'students','id'=>$row->id))); ?>"  ><i class="fa fa-users"></i> <?php echo e(__lang('student-downloads')); ?> (<?php echo e(\App\Certificate::find($row->id)->studentCertificates()->count()); ?>)</a>

                                                       </div>
                                                     </div>


                            </td>
                        </tr>
                    <?php endforeach;  ?>

                    </tbody>
                </table>

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
                    array(
                        'route' => 'admin/default',
                        'controller'=>'certificate',
                        'action'=>'index',
                    )
                );
                ?>
            </div><!--end .box-body -->
        </div><!--end .box -->
    </div><!--end .col-lg-12 -->
</div>


<!-- START SIMPLE MODAL MARKUP --><!-- /.modal -->
<!-- END SIMPLE MODAL MARKUP -->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\resources\views/admin/certificate/index.blade.php ENDPATH**/ ?>