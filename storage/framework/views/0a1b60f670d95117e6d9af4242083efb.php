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
<div >
    <div class="card">
        <div class="card-header">
             <?php echo e(__lang('edit')); ?> &nbsp;  <strong><?php echo e($row->user->name); ?> <?php echo e($row->user->last_name); ?></strong>
        </div>
        <div class="card-body">

              <ul class="nav nav-pills" id="myTab3" role="tablist">
                                    <li class="nav-item">
                                      <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="true"><?php echo e(__lang('student-details')); ?></a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="false"><?php echo e(__lang('change-password')); ?></a>
                                    </li>
                                  </ul>
                                  <div class="tab-content" id="myTabContent2">
                                    <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">

                                        <form enctype="multipart/form-data" method="post" action="<?php echo e(adminUrl(array('controller'=>'student','action'=>$action,'id'=>$id))); ?>">
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



                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div >
                                                            <label for="password1" class="control-label"><?php echo e(formLabel($form->get('picture'))); ?></label>
                                                        </div>
                                                        <div >
                                                         <div>
                                                            <?php if(!empty($row->user->picture) && isUrl($row->user->picture)): ?>
                                                            <img src="<?php echo e($row->user->picture); ?>" style="max-width: 200px" alt=""/>
                                                            <?php elseif(!empty($row->user->picture) && isImage($row->user->picture)): ?>
                                                            <img src="<?php echo e(resizeImage($row->user->picture,200,200,basePath())); ?>" alt=""/>

                                                            <?php endif;  ?>
                                                        </div>
                                                    <?php if(!empty($row->user->picture)):  ?>
                                                            <br>
                                                            <a class="btn btn-danger btn-sm" onclick="return confirm('<?php echo e(addslashes(__lang('confirm-delete'))); ?>')" href="<?php echo e(adminUrl(['controller'=>'student','action'=>'removeimage','id'=>$row->id])); ?>"><i class="fa fa-trash"></i> <?php echo e(__lang('Remove image')); ?></a>
                                                            <br><br>
                                                           <?php endif;  ?>
                                                            <?php echo e(formElement($form->get('picture'))); ?> <p class="help-block"><?php echo e(formElementErrors($form->get('picture'))); ?></p>
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
                                                <button type="submit" class="btn btn-primary btn-block"><?php echo e(__lang('save-changes')); ?></button>
                                            </div>

                                        </form>





                                    </div>
                                    <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">


                                        <form method="post" class="form form-horizontal"
                                              action="<?php echo e(adminUrl( ['controller' => 'student', 'action' => 'changepassword', 'id' => $id])); ?>">
                                            <?php echo csrf_field(); ?>
                                            <div class="form-group">
                                                <label for=""><?php echo e(__lang('new-password')); ?></label>
                                                <input required class="form-control" type="password" name="password"/>
                                            </div>

                                            <div class="form-group">
                                                <label for=""><?php echo e(__lang('confirm-password')); ?></label>
                                                <input required class="form-control" type="password" name="confirm_password"/>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" name="notify" value="1" checked/>
                                                <label for=""><?php echo e(__lang('send-new-password')); ?></label>
                                            </div>
                                            <button class="btn btn-primary btn-block" type="submit"><?php echo e(__lang('save')); ?></button>
                                        </form>




                                    </div>

                                  </div>

        </div><!--end .box -->
    </div><!--end .col-lg-12 -->


</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\resources\views/admin/student/edit.blade.php ENDPATH**/ ?>