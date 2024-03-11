<?php if($pageCount  && $pageCount > 1): ?>

    <nav aria-label="...">
        <ul class="pagination">
            <?php if(isset($previous)): ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo e($route); ?>?<?php echo e(http_build_query(array_merge($_GET,array('page' => $previous)))); ?>" tabindex="-1">
                    &laquo;
                </a>
            </li>
            <?php else: ?>
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">
                        &laquo;
                    </a>
                </li>
            <?php endif; ?>

            <?php $__currentLoopData = $pagesInRange; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page != $current): ?>
            <li class="page-item"><a class="page-link" href="<?php echo e($route); ?>?<?php echo e(http_build_query(array_merge($_GET,array('page' => $page)))); ?>"><?php echo e($page); ?></a></li>
                    <?php else: ?>
            <li class="page-item active">
                <a class="page-link" href="#"><?php echo e($page); ?> <span class="sr-only">(<?php echo e(__lang('current')); ?>)</span></a>
            </li>
                    <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if(isset($next)): ?>

            <li class="page-item">
                <a class="page-link" href="<?php echo e($route); ?>?<?php echo e(http_build_query(array_merge($_GET,array('page' => $next)))); ?>">&raquo;</a>
            </li>
                <?php else: ?>
                    <li class="page-item disabled">
                        <a class="page-link" href="#">&raquo;</a>
                    </li>
                <?php endif; ?>
        </ul>
    </nav>

<?php endif; ?>

<?php /**PATH C:\Users\DHRUVESH TRIPATHI\Videos\base_file_aiipl\resources\views/partials/paginator.blade.php ENDPATH**/ ?>