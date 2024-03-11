<?php $__env->startSection('page-title',''); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php echo $__env->make('admin.partials.crumb',[
    'crumbs'=>[
            route('admin.dashboard')=>__('default.dashboard'),
            '#'=>isset($pageTitle)?$pageTitle:''
        ]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>


<form action="<?php echo e(adminUrl(array('controller'=>'setting','action'=>'index'))); ?>" method="post">
    <?php echo csrf_field(); ?>
<div class="row mb-3">
    <div   >
        <button class="btn btn-primary float-right" type="submit"><i class="fa fa-save"></i> <?php echo e(__lang('save-changes')); ?></button>
    </div><!--end .col-lg-12 -->
</div>

<div >
    <div >



        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills" data-toggle="tabs">
                    <li class="nav-item"><a class="nav-link active"  href="#general" data-toggle="tab"><i class="fa fa-fw fa-cogs"></i> <?php echo e(__lang('general')); ?></a></li>
                    <li class="nav-item"><a class="nav-link"  href="#logo" data-toggle="tab"><i class="fa fa-fw fa-images"></i> <?php echo e(__lang('logo-icon')); ?></a></li>
                    <li class="nav-item"><a class="nav-link"  href="#menu" data-toggle="tab"><i class="fa fa-fw fa-list"></i> <?php echo e(__lang('menu')); ?></a></li>
                     <li class="nav-item"><a class="nav-link"  href="#labels" data-toggle="tab"><i class="fa fa-fw fa-tag"></i> <?php echo e(__lang('labels')); ?></a></li>
                     <li class="nav-item"><a class="nav-link"  href="#regis" data-toggle="tab"><i class="fa fa-fw fa-user-plus"></i> <?php echo e(__lang('registration')); ?></a></li>
                    <li class="nav-item"><a class="nav-link"  href="#mail" data-toggle="tab"><i class="fa fa-fw fa-envelope"></i> <?php echo e(__lang('mail')); ?></a></li>
                    <li class="nav-item"><a class="nav-link"  href="#info" data-toggle="tab"><i class="fa fa-fw fa-info"></i> <?php echo e(__lang('info')); ?></a></li>
                    <li class="nav-item"><a class="nav-link"  href="#social" data-toggle="tab"><i class="fa fa-fw fa-sign-in-alt"></i> <?php echo e(__lang('social-login')); ?></a></li>
                    <?php if(!saas()): ?>
                        <li class="nav-item"><a class="nav-link"  href="#video" data-toggle="tab"><i class="fa fa-fw fa-file-video"></i> <?php echo e(__lang('video-storage')); ?></a></li>
                    <?php endif; ?>

                    <li class="nav-item"><a class="nav-link"  href="#zoom" data-toggle="tab"><i class="fa fa-fw fa-video"></i> Zoom</a></li>
                </ul>
            </div>

            <div class="box-body tab-content">
                <div class="tab-pane active " id="general">

                    <div class="form-group">
                        <div class="col-md-12">
                            <?php echo e(formLabel($form->get('country_id'))); ?>

                        </div>
                        <div class="col-md-12">

                            <?php echo e(formElement($form->get('country_id'))); ?>


                        </div>
                    </div>


                    <?php foreach($settings as $row): ?>
                        <?php if(preg_match('#^general_(.*)$#i',$row->key)): ?>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <?php echo e(formLabel($form->get($row->key))); ?>

                                </div>
                                <div class="col-sm-12">
                                        <?php echo e(formElement($form->get($row->key))); ?>


                                </div>
                            </div>
                        <?php endif;  ?>
                    <?php endforeach;  ?>






                </div>

                <div class="tab-pane fade" id="logo">


                    <div class="form-group col-sm-6" style="margin-bottom:10px">

                        <label for="image" class="control-label"><?php echo e(__lang('logo')); ?></label><br />


                        <div class="image"><img data-name="image" src="<?php echo e($logo); ?>" alt="" id="thumb_logo" /><br />
                            <?php echo e(formElement($form->get('image_logo'))); ?>

                            <a class="pointer" onclick="image_upload('image_logo', 'thumb_logo');"><?php echo e(__lang('browse')); ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="pointer" onclick="$('#thumb_logo').attr('src', '<?php echo e($no_image); ?>'); $('#image_logo').attr('value', '');"><?php echo e(__lang('clear')); ?></a></div>

                    </div>

                    <div class="form-group col-sm-6" style="margin-bottom:10px">

                        <label for="image" class="control-label"><?php echo e(__lang('favicon')); ?></label><br />


                        <div class="image"><img data-name="image" src="<?php echo e($icon); ?>" alt="" id="thumb_icon" /><br />
                            <?php echo e(formElement($form->get('image_icon'))); ?>

                            <a class="pointer" onclick="image_upload('image_icon', 'thumb_icon');"><?php echo e(__lang('browse')); ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="pointer" onclick="$('#thumb_icon').attr('src', '<?php echo e($no_image); ?>'); $('#image_icon').attr('value', '');"><?php echo e(__lang('clear')); ?></a></div>

                    </div>



                    <div class="form-group">
                        <div class="col-sm-4">

                        </div>
                        <div class="col-sm-7">



                        </div>
                    </div>




                </div>

                <div class="tab-pane fade" id="menu">
                    <?php foreach($settings as $row): ?>
                        <?php if(preg_match('#^menu_(.*)$#i',$row->key)): ?>
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <?php echo e(formLabel($form->get($row->key))); ?>

                                </div>
                                <div class="col-sm-7">
                                        <?php echo e(formElement($form->get($row->key))); ?>

                                </div>
                            </div>
                        <?php endif;  ?>
                    <?php endforeach;  ?>
                </div>

                <div class="tab-pane fade" id="labels">

                    <?php foreach($settings as $row): ?>
                        <?php if(preg_match('#^label_(.*)$#i',$row->key)): ?>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <?php echo e(formLabel($form->get($row->key))); ?>

                                </div>
                                <div class="col-sm-12">
                                        <?php echo e(formElement($form->get($row->key))); ?>


                                </div>
                            </div>
                        <?php endif;  ?>
                    <?php endforeach;  ?>

                </div>

                <div class="tab-pane fade" id="regis">

                    <?php foreach($settings as $row): ?>
                        <?php if(preg_match('#^regis_(.*)$#i',$row->key)): ?>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <?php echo e(formLabel($form->get($row->key))); ?>

                                </div>
                                <div class="col-sm-12">
                                        <?php echo e(formElement($form->get($row->key))); ?>


                                </div>
                            </div>
                        <?php endif;  ?>
                    <?php endforeach;  ?>

                </div>

                <div class="tab-pane fade" id="mail">

                    <?php foreach($settings as $row): ?>
                        <?php if(preg_match('#^mail_(.*)$#i',$row->key)): ?>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <?php echo e(formLabel($form->get($row->key))); ?>

                                </div>
                                <div class="col-sm-12">
                                        <?php echo e(formElement($form->get($row->key))); ?>


                                </div>
                            </div>
                        <?php endif;  ?>
                    <?php endforeach;  ?>

                </div>



                <div class="tab-pane fade" id="social">
                    <p>
                        <h4><?php echo e(__lang('callback-urls')); ?></h4>
                    <ul>
                        <li>Facebook: <?php echo e($siteUrl); ?>/student/social-login?network=Facebook</li>
                        <li>Google: <?php echo e($siteUrl); ?>/student/social-login?network=Google</li>
                    </ul>
                    </p>
                    <?php foreach($settings as $row): ?>
                        <?php if(preg_match('#^social_(.*)$#i',$row->key)): ?>
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <?php echo e(formLabel($form->get($row->key))); ?>

                                </div>
                                <div class="col-sm-7">
                                        <?php echo e(formElement($form->get($row->key))); ?>


                                </div>
                            </div>
                        <?php endif;  ?>
                    <?php endforeach;  ?>
                </div>
                <div class="tab-pane fade" id="info">

                    <?php foreach($settings as $row): ?>
                    <?php if(preg_match('#^info_(.*)$#i',$row->key)): ?>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <?php echo e(formLabel($form->get($row->key))); ?>

                        </div>
                        <div class="col-sm-12">
                            <?php echo e(formElement($form->get($row->key))); ?>


                        </div>
                    </div>
                    <?php endif;  ?>
                    <?php endforeach;  ?>

                </div>
                <?php if(!saas()): ?>
                <div class="tab-pane fade" id="video">
                    <?php foreach($settings as $row): ?>
                        <?php if(preg_match('#^video_(.*)$#i',$row->key)): ?>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <?php echo e(formLabel($form->get($row->key))); ?>

                                </div>
                                <div class="col-sm-12">

                                        <?php echo e(formElement($form->get($row->key))); ?>


                                </div>
                            </div>
                        <?php endif;  ?>
                    <?php endforeach;  ?>
                </div>
                <?php endif; ?>
                <div class="tab-pane fade" id="zoom">
                    <?php foreach($settings as $row): ?>
                        <?php if(preg_match('#^zoom_(.*)$#i',$row->key)): ?>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <?php echo e(formLabel($form->get($row->key))); ?>

                                </div>
                                <div class="col-md-8">

                                        <?php echo e(formElement($form->get($row->key))); ?>


                                </div>
                            </div>
                        <?php endif;  ?>
                    <?php endforeach;  ?>
                </div>

            </div>

        </div>
    </div><!--end .col-lg-12 -->
</div>



 </form>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('client/vendor/colorpicker/jquery.colorpicker.css')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <script type="text/javascript" src="<?php echo e(asset('client/vendor/ckeditor/ckeditor.js')); ?>"></script>
    <script src="<?php echo e(basePath()); ?>/client/vendor/colorpicker/jquery.colorpicker.js"></script>
    <?php foreach($settings as $row): ?>
    <?php if($row->class == 'rte'): ?>
    <script type="text/javascript">

        CKEDITOR.replace('rte_<?php echo e($row->key); ?>', {
            filebrowserBrowseUrl: '<?php echo e(basePath()); ?>/admin/filemanager',
            filebrowserImageBrowseUrl: '<?php echo e(basePath()); ?>/admin/filemanager',
            filebrowserFlashBrowseUrl: '<?php echo e(basePath()); ?>/admin/filemanager'
        });

    </script>
    <?php endif;  ?>

    <?php endforeach;  ?>


    <script type="text/javascript">
        $(function() {
            $('.colorpicker-full').colorpicker({
                parts:          'full',
                showOn:         'both',
                buttonColorize: true,
                showNoneButton: true,
                buttonImage : '<?php echo e(basePath()); ?>/static/colorpicker/images/ui-colorpicker.png'
            });
        });
    </script>

    <script type="text/javascript"><!--
        function image_upload(field, thumb) {
            console.log('Field: '+field+'. Thumb:'+thumb);
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
                    else{
                        console.log('no field content');
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
        //--></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DHRUVESH TRIPATHI\Videos\base_file_aiipl\resources\views/admin/setting/index.blade.php ENDPATH**/ ?>