<?php $__currentLoopData = $crumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $path=>$label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="breadcrumb-item"><?php if($path != '#'): ?><a href="<?php echo e($path); ?>" ><?php endif; ?><?php echo e($label); ?><?php if($path != '#'): ?></a><?php endif; ?></div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\Users\DHRUVESH TRIPATHI\Videos\base_file_aiipl\resources\views/admin/partials/crumb.blade.php ENDPATH**/ ?>