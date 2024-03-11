<?php $__env->startSection('pageTitle',__('default.site-theme')); ?>
<?php $__env->startSection('innerTitle',__('default.site-theme')); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php echo $__env->make('admin.partials.crumb',[
    'crumbs'=>[
            route('admin.dashboard')=>__('default.dashboard'),
            '#'=>__('default.site-theme')
        ]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <?php echo app('translator')->get('default.active-template'); ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div style="width: 100%; height: 121px; overflow: hidden" class="rounded">
                                <a href="#"   data-toggle="modal" data-target="#<?php echo e($currentTemplate->directory); ?>Modal" > <img src="<?php echo e(asset('templates/'.$currentTemplate->directory.'/preview.jpg')); ?>"  class="img-fluid rounded mx-auto d-block" /></a>
                            </div>
                            </div>
                        <div class="col-md-6">
                            <h3><?php echo e($currentTemplate->name); ?></h3>
                            <p>
                                <?php echo app('translator')->get(tlang($currentTemplate->directory,'app-description')); ?>
                            </p>
                            <!-- Default dropup button -->
                            <div class="btn-group dropup">
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-cogs"></i> <?php echo app('translator')->get('default.customize'); ?>
                                </button>
                                <div class="dropdown-menu wide-btn">
                                    <a class="dropdown-item" href="<?php echo e(route('admin.templates.settings')); ?>"><?php echo app('translator')->get('default.settings'); ?></a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.templates.colors')); ?>"><?php echo app('translator')->get('default.colors'); ?></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="card">
        <div class="card-header"><?php echo app('translator')->get('default.all-templates'); ?></div>
        <div class="card-body">
            <div class="row">

                <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 int_mb60 mb-5"  >
                        <div class="row">
                            <div class="col-md-6">
                                <div style="width: 100%; height: 121px; overflow: hidden" class="rounded">
                                <a href="#"  data-toggle="modal" data-target="#<?php echo e($template); ?>Modal" ><img src="<?php echo e(asset('templates/'.$template.'/preview.jpg')); ?>"  class="img-fluid rounded mx-auto d-block" /></a>
                                </div>
                                <?php $__env->startSection('footer'); ?>
                                    <?php echo \Illuminate\View\Factory::parentPlaceholder('footer'); ?>
                                <!-- Modal -->
                                <div class="modal fade" id="<?php echo e($template); ?>Modal" tabindex="-1" role="dialog" aria-labelledby="<?php echo e($template); ?>ModalLabel" aria-hidden="true">
                                    <div class="modal-dialog  modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="<?php echo e($template); ?>ModalLabel"><?php echo e(templateInfo($template)['name']); ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            <small><?php echo e(__lang('preview-notice')); ?></small>
                                                <img src="<?php echo e(asset('templates/'.$template.'/preview.jpg')); ?>"  class="img-fluid" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <?php $__env->stopSection(); ?>


                            </div>
                            <div class="col-md-6">
                                <h3><?php echo e(templateInfo($template)['name']); ?></h3>
                                <p>
                                    <?php echo app('translator')->get(tlang($template,'app-description')); ?>
                                </p>
                                <!-- Default dropup button -->
                                <?php if($currentTemplate->directory ==$template): ?>
                                <div class="btn-group dropup">
                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-cogs"></i> <?php echo app('translator')->get('default.customize'); ?>
                                    </button>
                                    <div class="dropdown-menu wide-btn">
                                        <a class="dropdown-item" href="<?php echo e(route('admin.templates.settings')); ?>"><?php echo app('translator')->get('default.settings'); ?></a>
                                        <a class="dropdown-item" href="<?php echo e(route('admin.templates.colors')); ?>"><?php echo app('translator')->get('default.colors'); ?></a>
                                    </div>
                                </div>
                                    <?php else: ?>
                                    <a class="btn btn-primary" href="<?php echo e(route('admin.templates.install',['templateDir'=>$template])); ?>"><i class="fa fa-download"></i> <?php echo app('translator')->get('default.install'); ?></a>
                                <?php endif; ?>

                            </div>
                        </div>

                    </div>


                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>


        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DHRUVESH TRIPATHI\Videos\base_file_aiipl\resources\views/admin/templates/index.blade.php ENDPATH**/ ?>