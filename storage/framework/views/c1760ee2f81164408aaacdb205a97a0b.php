<?php $__env->startSection('page-title',$title); ?>
<?php $__env->startSection('inline-title',$title); ?>

<?php $__env->startSection('content'); ?>
    <section class="about-area them-2 pb-130 pt-50">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="about-content them-2">
                        <?php echo $content; ?>

                    </div>
                    <!-- about content -->
                </div>
            </div> <!-- row -->
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(TLAYOUT, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\public\templates/edugrids/views/site/home/info.blade.php ENDPATH**/ ?>