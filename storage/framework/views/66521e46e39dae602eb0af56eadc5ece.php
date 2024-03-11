<?php $__env->startSection('page-title',''); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php echo $__env->make('admin.partials.crumb',[
    'crumbs'=>[
            route('admin.dashboard')=>__('default.dashboard'),
            '#'=>isset($pageTitle)?$pageTitle:''
        ]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('search-form'); ?>
    <form class="form-inline mr-auto" method="get" action="<?php echo e(adminUrl(array('controller'=>'test','action'=>'index'))); ?>">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>
        <div class="search-element">
            <input value="<?php echo e(request()->get('filter')); ?>"   name="filter" class="form-control" type="search" placeholder="<?php echo e(__lang('search')); ?>" aria-label="<?php echo e(__lang('search')); ?>" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
        </div>
    </form>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
<div>
    <div >
        <div class="card">
            <div class="card-header">

                <a class="btn btn-primary float-right" href="<?php echo e(adminUrl(array('controller'=>'test','action'=>'add'))); ?>"><i class="fa fa-plus"></i> <?php echo e(__lang('add-test')); ?></a>


            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th><?php echo e(__lang('id')); ?></th>
                        <th><?php echo e(__lang('name')); ?></th>
                        <th><?php echo e(__lang('enabled')); ?></th>
                        <th><?php echo e(__lang('private')); ?></th>
                        <th><?php echo e(__lang('questions')); ?></th>
                        <th><?php echo e(__lang('attempts')); ?></th>

                        <?php if(GLOBAL_ACCESS): ?>
                        <th><?php echo e(__lang('created-by')); ?></th>
                        <?php endif;  ?>
                        <th class="text-right"><?php echo e(__lang('actions')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($paginator as $row):  ?>
                        <tr>
                            <td><span class="label label-success"><?php echo e($row->id); ?></span></td>
                            <td><?php echo e($row->name); ?></td>
                            <td><?php echo e(boolToString($row->enabled)); ?></td>
                            <td><?php echo e(boolToString($row->private)); ?></td>
                            <td><?php echo e($questionTable->getTotalQuestions($row->id)); ?></td>
                            <td> <a class="btn btn-sm btn-primary" href="<?php echo e(adminUrl(['controller'=>'test','action'=>'results','id'=>$row->id])); ?>"><?php echo e($studentTestTable->getTotalForTest($row->id)); ?> (<?php echo e(__lang('view')); ?>)</a></td>
                        <?php if(GLOBAL_ACCESS): ?>
                            <td><?php echo e(adminName($row->admin_id)); ?></td>
                        <?php endif;  ?>
                            <td >
                                <div class="btn-group dropleft ">
                                    <button type="button" class="btn btn-primary dropdown-toggle " data-toggle="dropdown">
                                        <i class="fa fa-gears"></i> <?php echo e(__lang('options')); ?>

                                    </button>
                                    <ul class="dropdown-menu wide-btn float-right animation-slide" role="menu" style="text-align: left;">
                                        <li><a class="dropdown-item" href="<?php echo e(adminUrl(array('controller'=>'test','action'=>'questions','id'=>$row->id))); ?>"  ><i class="fa fa-question-circle"></i> <?php echo e(__lang('manage-questions')); ?> </a></li>
                                        <li><a  class="dropdown-item" href="<?php echo e(adminUrl(array('controller'=>'test','action'=>'exportquestions','id'=>$row->id))); ?>"  ><i class="fa fa-download"></i> <?php echo e(__lang('export-questions')); ?></a> </li>
                                         <li><a class="dropdown-item"  href="<?php echo e(adminUrl(array('controller'=>'test','action'=>'edit','id'=>$row->id))); ?>"  ><i class="fa fa-edit"></i> <?php echo e(__lang('edit')); ?></a></li>
                                        <li><a class="dropdown-item"  href="<?php echo e(adminUrl(['controller'=>'test','action'=>'sessions','id'=>$row->id])); ?>"><i class="fa fa-calendar"></i> <?php echo e(__lang('manage-sessions-courses')); ?></a></li>
                                        <li><a  class="dropdown-item" onclick="return confirm('<?php echo e(__lang('test-duplicate-confirm')); ?>')"  href="<?php echo e(adminUrl(array('controller'=>'test','action'=>'duplicate','id'=>$row->id))); ?>" ><i class="fa fa-copy"></i> <?php echo e(__lang('duplicate')); ?></a></li>
                                        <li><a  class="dropdown-item" onclick="return confirm('<?php echo e(__lang('delete-confirm')); ?>')" href="<?php echo e(adminUrl(array('controller'=>'test','action'=>'delete','id'=>$row->id))); ?>"   ><i class="fa fa-trash"></i> <?php echo e(__lang('delete')); ?></a>
                                        </li>
                                    </ul>
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
                        'controller'=>'test',
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\resources\views/admin/test/index.blade.php ENDPATH**/ ?>