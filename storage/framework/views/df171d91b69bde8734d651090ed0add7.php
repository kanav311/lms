<?php $__env->startSection('page-title',''); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php echo $__env->make('admin.partials.crumb',[
    'crumbs'=>[
            route('admin.dashboard')=>__('default.dashboard'),
            route('admin.student.index')=>__lang('students'),
            '#'=>isset($pageTitle)?$pageTitle:''
        ]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div  >
			<div >
				<div class="card">
					<div class="card-header">
                        <strong> <?php echo e(__lang('student')); ?>  <?php echo e(__lang('details')); ?></strong>
					</div>
					<div class="card-body">

                                           <form enctype="multipart/form-data" action="<?php echo e(adminUrl(array('controller'=>'student','action'=>$action,'id'=>$id))); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                                <div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<div >
											<label for="password1" class="control-label"><?php echo e(formLabel($form->get('name'))); ?></label>
										</div>
										<div >
										 <?php echo e(formElement($form->get('name'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('name'))); ?></p>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<div >
											<label for="password1" class="control-label"><?php echo e(formLabel($form->get('last_name'))); ?></label>
										</div>
										<div >
										 <?php echo e(formElement($form->get('last_name'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('last_name'))); ?></p>
										</div>
									</div>
								</div>
							</div>








                            <div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<div >
											<label for="password1" class="control-label"><?php echo e(formLabel($form->get('email'))); ?></label>
										</div>
										<div >
										 <?php echo e(formElement($form->get('email'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('email'))); ?></p>
										</div>
									</div>
								</div>











                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div >
                                                <label for="password1" class="control-label"><?php echo e(formLabel($form->get('picture'))); ?></label>
                                            </div>
                                            <div >

                                                <?php echo e(formElement($form->get('picture'))); ?> <p class="help-block"><?php echo e(formElementErrors($form->get('picture'))); ?></p>
                                            </div>
                                        </div>
                                    </div>















                            </div>










                          <div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<div >
											<label for="password1" class="control-label"><?php echo e(formLabel($form->get('mobile_number'))); ?></label>
										</div>
										<div >
										 <?php echo e(formElement($form->get('mobile_number'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('mobile_number'))); ?></p>
										</div>
									</div>
								</div>
												<div class="col-sm-6">
									<div class="form-group">
										<div >
											<label for="password1" class="control-label"><?php echo e(formLabel($form->get('status'))); ?></label>
										</div>
										<div >
										 <?php echo e(formElement($form->get('status'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('status'))); ?></p>
										</div>
									</div>
								</div>
							</div>

                                                    <div class="row">

                                                        <?php foreach($fields as $row): ?>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">

                                                                <?php if($row->type == 'checkbox'): ?>

                                                                <div >
                                                                    <?php echo e(formElement($form->get('custom_'.$row->id))); ?>

                                                                    <label for="password1" class="control-label"><?php echo e(formLabel($form->get('custom_'.$row->id))); ?></label>
                                                                    <p class="help-block"><?php echo e(formElementErrors($form->get('custom_'.$row->id))); ?></p>
                                                                </div>

                                                                <?php elseif($row->type == 'radio'):  ?>
                                                                    <div >
                                                                        <label for="password1" class="control-label"><?php echo e(formLabel($form->get('custom_'.$row->id))); ?></label>
                                                                    </div>
                                                                    <div >
                                                                        <?php echo e(formElement($form->get('custom_'.$row->id))); ?>

                                                                          <p class="help-block"><?php echo e(formElementErrors($form->get('custom_'.$row->id))); ?></p>
                                                                    </div>
                                                                <?php else:  ?>

                                                                    <div >
                                                                        <label for="password1" class="control-label"><?php echo e(formLabel($form->get('custom_'.$row->id))); ?></label>
                                                                    </div>
                                                                    <div >
                                                                        <?php echo e(formElement($form->get('custom_'.$row->id))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('custom_'.$row->id))); ?></p>
                                                                    </div>

                                                                <?php endif;  ?>


                                                            </div>
                                                        </div>

                                                        <?php endforeach;  ?>

                                                    </div>










                                                    <div class="form-footer col-lg-offset-1 col-md-offset-2 col-sm-offset-3">
								<button type="submit" class="btn btn-lg btn-block btn-primary"><?php echo e(__lang('save-changes')); ?></button>
							</div>
						</form>
					</div>

				</div><!--end .box -->
			</div><!--end .col-lg-12 -->
		</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\resources\views/admin/student/add.blade.php ENDPATH**/ ?>