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

					<div class="card-body">

                        <form method="post" action="<?php echo e(adminUrl(array('controller'=>'certificate','action'=>$action,'id'=>$id))); ?>">
                            <?php echo csrf_field(); ?>


									<div class="form-group">
											<?php echo e(formLabel($form->get('name'))); ?>

										 <?php echo e(formElement($form->get('name'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('name'))); ?></p>

									</div>


                        <div class="form-group">
                            <?php echo e(formLabel($form->get('course_id'))); ?>

                            <?php echo e(formElement($form->get('course_id'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('course_id'))); ?></p>

                        </div>

						 	<div class="form-group">
											<?php echo e(formLabel($form->get('description'))); ?>

										 <?php echo e(formElement($form->get('description'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('description'))); ?></p>

									</div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo e(formLabel($form->get('enabled'))); ?>

                                    <?php echo e(formElement($form->get('enabled'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('enabled'))); ?></p>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo e(formLabel($form->get('orientation'))); ?>

                                    <?php echo e(formElement($form->get('orientation'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('orientation'))); ?></p>

                                </div>


                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo e(formLabel($form->get('max_downloads'))); ?>

                                    <?php echo e(formElement($form->get('max_downloads'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('max_downloads'))); ?></p>
                                    <p class="help-block"><?php echo e(__lang('download-help')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" style="margin-bottom:10px">

                                    <label for="image" class="control-label"><?php echo e(__lang('certificate-image')); ?>(A4 <?php echo e(__lang('size')); ?> - 595 <?php echo e(__lang('pixels')); ?> x 842 <?php echo e(__lang('pixels')); ?>)</label><br />


                                    <div class="image"><img data-name="image" src="<?php echo e($display_image); ?>" alt="" id="thumb" /><br />
                                        <?php echo e(formElement($form->get('image'))); ?>

                                        <a class="pointer" onclick="image_upload('image', 'thumb');"><?php echo e(__lang('browse')); ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="pointer" onclick="$('#thumb').attr('src', '<?php echo e($no_image); ?>'); $('#image').attr('value', '');"><?php echo e(__lang('clear')); ?></a></div>

                                </div>
                            </div>

                        </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo e(formLabel($form->get('payment_required'))); ?>

                                        <?php echo e(formElement($form->get('payment_required'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('payment_required'))); ?></p>

                                    </div>
                                </div>
                                <div class="col-md-6" id="priceBox" style="display: none">
                                    <div class="form-group">
                                        <?php echo e(formLabel($form->get('price'))); ?>

                                        <?php echo e(formElement($form->get('price'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('price'))); ?></p>

                                    </div>


                                </div>
                            </div>
















							<div class="form-footer">
								<button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> <?php echo e(__lang('save')); ?></button>
							</div>
						 </form>
					</div>
				</div><!--end .box -->
			</div><!--end .col-lg-12 -->
		</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <script type="text/javascript" src="<?php echo e(asset('client/vendor/ckeditor/ckeditor.js')); ?>"></script>
    <script type="text/javascript">

        CKEDITOR.replace('hcontent', {
            filebrowserBrowseUrl: '<?php echo e(basePath()); ?>/admin/filemanager',
            filebrowserImageBrowseUrl: '<?php echo e(basePath()); ?>/admin/filemanager',
            filebrowserFlashBrowseUrl: '<?php echo e(basePath()); ?>/admin/filemanager'
        });

        $(function(){
           $('#payment_required').change(function(val){
               console.log($(this).val());
               if($(this).val()==1){
                   console.log('showing box');
                   $('#priceBox').show();
               }
               else{
                   $('#priceBox').hide();
               }
           });
            $('#payment_required').trigger('change');
        });

    </script>
    <script type="text/javascript">
        function image_upload(field, thumb) {
            console.log('image upload');
            $('#dialog').remove();

            $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="<?php echo e(basePath()); ?>/admin/filemanager?&token=true&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');

            $('#dialog').dialog({
                title: '<?php echo e(addslashes(__lang('Image Manager'))); ?>',
                close: function (event, ui) {
                    if ($('#' + field).attr('value')) {
                        $.ajax({
                            url: '<?php echo e(basePath()); ?>/admin/filemanager/image?&image=' + encodeURIComponent($('#' + field).val()),
                            dataType: 'text',
                            success: function(data) {
                                $('#' + thumb).replaceWith('<img src="' + data + '" alt="" id="' + thumb + '" />');
                            }
                        });
                    }
                },
                bgiframe: false,
                width: 800,
                height: 570,
                resizable: true,
                modal: false,
                position: "center"
            });
        };

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\resources\views/admin/certificate/add.blade.php ENDPATH**/ ?>