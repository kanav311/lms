<?php $__env->startSection('page-title',''); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php echo $__env->make('admin.partials.crumb',[
    'crumbs'=>[
            route('admin.dashboard')=>__('default.dashboard'),
            '#'=>__lang('students')
        ]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('search-form'); ?>
    <form class="form-inline mr-auto" method="get" action="<?php echo e(route('admin.student.index')); ?>">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>
        <div class="search-element">
            <input value="<?php echo e(request()->get('filter')); ?>"   name="filter" class="form-control" type="search" placeholder="<?php echo e(__lang('filter-name-email')); ?>" aria-label="<?php echo e(__lang('search')); ?>" data-width="250">


            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div >
			<div >
				<div class="card">
					<div class="card-header">
                        <a class="btn btn-primary float-right" href="<?php echo e(adminUrl(array('controller'=>'student','action'=>'add'))); ?>"><i class="fa fa-plus"></i> <?php echo e(__lang('add-student')); ?></a>



					</div>
					<div class="card-body">

                        <div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th><?php echo e(__lang('id')); ?></th>
                                    <th></th>
									<th><?php echo e(__lang('first-name')); ?></th>
									<th><?php echo e(__lang('last-name')); ?></th>
									<th><?php echo e(__lang('courses-sessions')); ?></th>
									<th class="text-right1"  ><?php echo e(__lang('actions')); ?></th>
								</tr>
							</thead>
							<tbody>
                            <?php foreach($paginator as $row):  ?>
								<tr>
									<td><span class="label label-success"><?php echo e($row->id); ?></span></td>
                                    <td>
                                        <img  class="mr-3 rounded-circle"    width="50" src="<?php echo e(profilePictureUrl($row->picture)); ?>" />
                                    </td>
									<td><?php echo e($row->name); ?></td>
									<td><?php echo e($row->last_name); ?></td>
									<td><strong><?php echo e($studentSessionTable->getTotalForStudent($row->id)); ?></strong></td>

									<td >
										<a href="<?php echo e(adminUrl(array('controller'=>'student','action'=>'edit','id'=>$row->id))); ?>" class="btn btn-xs btn-primary btn-equal" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e(__lang('edit')); ?>"><i class="fa fa-edit"></i></a>
                                        <a href="#" onclick="openModal('<?php echo e(__lang('enroll')); ?>','<?php echo e(adminUrl(array('controller'=>'student','action'=>'enroll','id'=>$row->id))); ?>')"  data-toggle="tooltip" data-placement="top" data-original-title="Enroll"   title="<?php echo e(__lang('Enroll')); ?>" type="button" class="btn btn-xs btn-primary btn-equal"  ><i class="fa fa-plus"></i></a>

                                        <button   data-id="<?php echo e($row->id); ?>" data-toggle="modal" data-target="#simpleModal" title="<?php echo app('translator')->get('default.view'); ?>" type="button" class="btn btn-xs btn-primary btn-equal viewbutton"  ><i class="fa fa-eye"></i></button>
										<a onclick="return confirm('<?php echo e(__lang('delete-confirm')); ?>')" href="<?php echo e(adminUrl(array('controller'=>'student','action'=>'delete','id'=>$row->id))); ?>"  class="btn btn-xs btn-primary btn-equal" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e(__lang('delete')); ?>"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
								  <?php endforeach;  ?>

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
     array(
         'route' => 'admin/default',
		 'controller'=>'student',
		 'action'=>'index',
         'filter'=>$filter
     )
 );
 ?>
					</div><!--end .box-body -->
				</div><!--end .box -->
			</div><!--end .col-lg-12 -->
		</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <div class="modal fade" id="simpleModal"  tabindex="-1" role="dialog" id="exampleModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(__lang('student-details')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="info">
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo e(__lang('close')); ?></button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function(){
            $('.viewbutton').click(function(){
                $('#info').text('Loading...');
                var id = $(this).attr('data-id');
                $('#info').load('<?php echo e(adminUrl(array('controller'=>'student','action'=>'view'))); ?>'+'/'+id);
            });
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DHRUVESH TRIPATHI\Videos\base_file_aiipl\resources\views/admin/student/index.blade.php ENDPATH**/ ?>