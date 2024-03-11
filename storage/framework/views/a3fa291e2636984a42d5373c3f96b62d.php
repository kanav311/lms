<?php $__env->startSection('page-title',''); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php echo $__env->make('admin.partials.crumb',[
    'crumbs'=>[
            route('admin.dashboard')=>__('default.dashboard'),
            route('admin.test.index')=>__lang('tests'),
            '#'=>isset($pageTitle)?$pageTitle:''
        ]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('search-form'); ?>
    <form class="form-inline mr-auto" method="get" action="<?php echo e(adminUrl(array('controller'=>'test','action'=>'results','id'=>$row->id))); ?>">
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
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="far fa-thumbs-up"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4><?php echo e(__lang('passed')); ?></h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($passed); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-thumbs-down"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4><?php echo e(__lang('failed')); ?></h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($failed); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-chart-bar"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4><?php echo e(__lang('average-score')); ?></h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($average); ?>%
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">



            </div>
        </div>


    <div >


        <div class="dropdown d-inline mr-2">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-download"></i>   <?php echo e(__lang('export')); ?>

            </button>
            <div class="dropdown-menu wide-btn">
                <a class="dropdown-item" href="<?php echo e(adminUrl(['controller'=>'test','action'=>'exportresult','id'=>$row->id])); ?>?type=pass&start=<?php echo e($start); ?>&end=<?php echo e($end); ?>" ><i class="fa fa-thumbs-up"></i> <?php echo e(__lang('export-passed')); ?></a>
                <a class="dropdown-item"  href="<?php echo e(adminUrl(['controller'=>'test','action'=>'exportresult','id'=>$row->id])); ?>?type=fail&start=<?php echo e($start); ?>&end=<?php echo e($end); ?>"><i class="fa fa-thumbs-down"></i> <?php echo e(__lang('export-failed')); ?></a>

            </div>
        </div>

        <button class="btn btn-success"  data-toggle="collapse" href="#collapseFilter" role="button" aria-expanded="false" aria-controls="collapseFilter"><i class="fa fa-filter"></i> <?php echo e(__lang('filter')); ?></button>
        <br> <br>
        <div class="collapse" id="collapseFilter">
            <div class="card card-body">
                <form id="filterform"    role="form"  method="get" action="<?php echo e(adminUrl(array('controller'=>'test','action'=>'results','id'=>$row->id))); ?>">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="sr-only" for="filter"><?php echo e(__lang('filter')); ?></label>

                                <input placeholder="<?php echo e(__lang('search')); ?>" name="filter" class="form-control" type="text" value="<?php echo e(@$_GET['filter']); ?>"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="sr-only" for="start"><?php echo e(__lang('start-date')); ?></label>

                                <input name="start" placeholder="<?php echo e(__lang('start-date')); ?>" class="form-control date" type="text" value="<?php echo e(@$_GET['start']); ?>"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="sr-only" for="end"><?php echo e(__lang('end-date')); ?></label>

                                <input name="end" placeholder="<?php echo e(__lang('end-date')); ?>" class="form-control date" type="text" value="<?php echo e(@$_GET['end']); ?>"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary"><?php echo e(__lang('filter')); ?></button>
                            <button type="button" onclick="$('#filterform input, #filterform select').val(''); $('#filterform').submit();" class="btn btn-secondary"><?php echo e(__lang('clear')); ?></button>

                        </div>

                    </div>






                </form>


            </div>
        </div>


        <div class="card">

            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th><?php echo e(__lang('student')); ?></th>
                        <th><?php echo e(__lang('date-taken')); ?></th>
                        <th><?php echo e(__lang('score')); ?></th>
                        <th><?php echo e(__lang('grade')); ?></th>
                        <th class="text-right"><?php echo e(__lang('actions')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($paginator as $row):  ?>
                        <tr>
                            <td><?php echo e($row->first_name); ?> <?php echo e($row->last_name); ?></td>
                            <td><?php echo e(showDate('d/M/Y',$row->created_at)); ?></td>
                            <td><?php echo e($row->score); ?>%</td>
                            <td><?php if($row->score >= $row->passmark):  ?>
                                <span style="color:green"><?php echo e(__lang('passed')); ?></span>
                                <?php else:  ?>
                                    <span style="color:red"><?php echo e(__lang('failed')); ?></span>
                                <?php endif;  ?>
                            </td>

                            <td class="text-right">
                                 <a onclick="openModal('<?php echo e($row->first_name); ?> <?php echo e($row->last_name); ?>','<?php echo e(adminUrl(array('controller'=>'test','action'=>'testresult','id'=>$row->id))); ?>')"  href="javascript:;" class="btn btn-xs btn-primary btn-equal" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e(__lang('view-result')); ?>"><i class="fa fa-eye"></i></a>
                                <a onclick="return confirm('<?php echo e(__lang('delete-confirm')); ?>')" href="<?php echo e(adminUrl(array('controller'=>'test','action'=>'deleteresult','id'=>$row->id))); ?>"  class="btn btn-xs btn-primary btn-equal" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e(__lang('delete')); ?>"><i class="fa fa-trash"></i></a>
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
                        'action'=>'results',
                        'id'=>$testID
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

<?php $__env->startSection('header'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('client/vendor/pickadate/themes/default.date.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/vendor/pickadate/themes/default.time.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/vendor/pickadate/themes/default.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/vendor/datatables/media/css/jquery.dataTables.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <script type="text/javascript" src="<?php echo e(asset('client/vendor/pickadate/picker.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('client/vendor/pickadate/picker.date.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('client/vendor/pickadate/picker.time.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('client/vendor/pickadate/legacy.js')); ?>"></script>
    <script type="text/javascript">
        jQuery('.date').pickadate({
            format: 'yyyy-mm-dd'
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\resources\views/admin/test/results.blade.php ENDPATH**/ ?>