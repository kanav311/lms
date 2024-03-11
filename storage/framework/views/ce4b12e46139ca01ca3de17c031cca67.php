<!DOCTYPE html>
<html <?php echo langMeta(); ?>>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?php echo $__env->yieldContent('pageTitle',isset($pageTitle)? $pageTitle:__('default.my-account')); ?> - <?php echo e(setting('general_site_name')); ?></title>

    <?php if(!empty(setting('image_icon'))): ?>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset(setting('image_icon'))); ?>">
    <?php endif; ?>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?php echo e(asset('client/themes/admin/assets/modules/bootstrap/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/themes/admin/assets/modules/fontawesome/css/all.min.css')); ?>">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('client/themes/admin/assets/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/themes/admin/assets/css/components.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/themes/admin/assets/css/custom.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('client/css/admin.css')); ?>">
    <link href="<?php echo e(asset('client/vendor/select2/css/select2.min.css')); ?>" rel="stylesheet" />
    <?php if(!empty(setting('dashboard_color'))): ?>
        <?php echo $__env->make('partials.dashboard-css',['color'=>setting('dashboard_color')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php echo setting('general_header_scripts'); ?>

    <?php echo $__env->yieldContent('header'); ?>
</head>

<body class="layout-3">
<div id="app">
    <div class="main-wrapper container">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <a href="<?php echo e(url('/')); ?>" class="navbar-brand sidebar-gone-hide"><?php echo e(limitLength(setting('general_site_name'),17)); ?></a>
            <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
            <div class="nav-collapse">
                <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
                    <i class="fas fa-ellipsis-v"></i>
                </a>
                <ul class="navbar-nav">
                    <li class="nav-item active"><a href="<?php echo e(url('/')); ?>" class="nav-link"><?php echo e(__lang('home')); ?></a></li>
                    <?php if(setting('menu_show_courses')==1): ?>
                    <li class="nav-item"><a href="<?php echo e(route('courses')); ?>" class="nav-link"><?php echo e(__lang('online-courses')); ?></a></li>
                    <?php endif; ?>
                    <?php if(setting('menu_show_sessions')==1): ?>
                    <li class="nav-item"><a href="<?php echo e(route('sessions')); ?>" class="nav-link"><?php echo e(__lang('upcoming-sessions')); ?></a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <form class="form-inline ml-auto" action="<?php echo e(route('courses')); ?>">
                <ul class="navbar-nav">
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                </ul>
                <div class="search-element">
                    <input name="filter" class="form-control" type="search" placeholder="<?php echo e(__lang('search-courses')); ?>" aria-label="Search" data-width="250">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>

                </div>
            </form>

            <ul class="navbar-nav navbar-right">
                <?php if(getCart()->hasItems()): ?>
                <li  ><a href="<?php echo e(route('cart')); ?>"   class="nav-link nav-link-lg  beep"><i class="fa fa-cart-plus"></i> <?php echo e(getCart()->getTotalItems()); ?></a></li>
                <?php endif; ?>
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <?php if(!empty(Auth::user()->picture) && file_exists(Auth::user()->picture)): ?>
                            <img alt="image" src="<?php echo e(resizeImage(Auth::user()->picture,50,50,url('/'))); ?>" class="rounded-circle mr-1">
                        <?php else: ?>
                            <img alt="image" src="<?php echo e(asset('client/themes/admin/assets/img/avatar/avatar-1.png')); ?>" class="rounded-circle mr-1">
                        <?php endif; ?>
                        <div class="d-sm-none d-lg-inline-block"><?php echo app('translator')->get('default.hi'); ?>, <?php echo e(limitLength(Auth()->user()->name,30)); ?></div></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-title"><?php echo app('translator')->get('default.account'); ?></div>
                        <a href="<?php echo route('student.student.profile'); ?>" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> <?php echo app('translator')->get('default.profile'); ?>
                        </a>
                        <a href="<?php echo route('student.student.password'); ?>" class="dropdown-item has-icon">
                            <i class="fas fa-unlock"></i> <?php echo app('translator')->get('default.change-password'); ?>
                        </a>
                        <a href="<?php echo route('student.student.billing'); ?>" class="dropdown-item has-icon">
                            <i class="fas fa-home"></i> <?php echo app('translator')->get('default.billing-address'); ?>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="#" class="dropdown-item has-icon text-danger">
                            <i class="fas fa-sign-out-alt"></i> <?php echo app('translator')->get('default.logout'); ?>
                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>



        <nav class="navbar navbar-secondary navbar-expand-lg">
            <div class="container">
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a href="<?php echo e(route('student.dashboard')); ?>" class="nav-link"><i class="fas fa-fire"></i><span><?php echo e(__lang('dashboard')); ?></span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="fas fa-chalkboard-teacher"></i><span><?php echo e(setting('label_my_sessions',__lang('my-courses'))); ?></span></a>
                        <ul class="dropdown-menu dropdown-border">
                            <li class="nav-item"><a href="<?php echo e(route('student.student.mysessions')); ?>" class="nav-link"><?php echo e(__lang('enrolled-courses')); ?></a></li>
                            <li class="nav-item"><a href="<?php echo e(route('student.course.bookmarks')); ?>" class="nav-link"><?php echo e(__lang('bookmarks')); ?></a></li>
                            <?php if(setting('menu_show_notes')==1): ?>
                            <li class="nav-item"><a href="<?php echo e(route('student.student.notes')); ?>" class="nav-link"><?php echo e(__lang('revision-notes')); ?></a></li>
                            <?php endif; ?>
                            <li class="nav-item"><a href="<?php echo e(route('student.student.surveys')); ?>" class="nav-link"><?php echo e(__lang('surveys')); ?></a></li>
                            <li class="nav-item"><a href="<?php echo e(route('student.student.invoices')); ?>" class="nav-link"><?php echo e(__lang('invoices')); ?></a></li>
                        </ul>
                    </li>
                    <?php if(setting('menu_show_certificates')==1 || setting('menu_show_downloads')==1): ?>
                    <li class="nav-item dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="fas fa-download"></i><span><?php echo e(setting('label_downloads',__lang('resources'))); ?></span></a>
                        <ul class="dropdown-menu dropdown-border">
                            <?php if(setting('menu_show_certificates')==1): ?>
                            <li class="nav-item"><a href="<?php echo e(route('student.student.certificates')); ?>" class="nav-link"><?php echo e(__lang('certificates')); ?></a></li>
                            <?php endif; ?>
                            <?php if(setting('menu_show_downloads')==1): ?>
                            <li class="nav-item"><a href="<?php echo e(route('student.download.index')); ?>" class="nav-link"><?php echo e(__lang('downloads')); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if(setting('menu_show_homework')==1): ?>
                    <li class="nav-item dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="fas fa-edit"></i><span><?php echo e(setting('label_homework',__lang('homework'))); ?></span></a>
                        <ul class="dropdown-menu dropdown-border">

                            <li class="nav-item"><a href="<?php echo e(route('student.assignment.index')); ?>" class="nav-link"><?php echo e(__lang('view-all')); ?></a></li>

                            <li class="nav-item"><a href="<?php echo e(route('student.assignment.submissions')); ?>" class="nav-link"><?php echo e(__lang('my-submissions')); ?></a></li>

                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if(setting('menu_show_discussions')==1): ?>
                    <li class="nav-item dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="fas fa-comments"></i><span><?php echo e(setting('label_discussion',__lang('discuss'))); ?></span></a>
                        <ul class="dropdown-menu dropdown-border">
                            <li class="nav-item"><a href="<?php echo e(route('student.student.discussion')); ?>" class="nav-link"><?php echo e(__lang('instructor-chat')); ?></a></li>
                            <li class="nav-item"><a href="<?php echo e(route('student.forum.index')); ?>" class="nav-link"><?php echo e(__lang('student-forum')); ?></a></li>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if(setting('menu_show_tests')==1): ?>
                    <li class="nav-item dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="fas fa-check-circle"></i><span><?php echo e(setting('label_take_test',__lang('tests'))); ?></span></a>
                        <ul class="dropdown-menu dropdown-border">
                            <li class="nav-item"><a href="<?php echo e(route('student.test.index')); ?>" class="nav-link"><?php echo e(__lang('browse-tests')); ?></a></li>
                            <li class="nav-item"><a href="<?php echo e(route('student.test.statement')); ?>" class="nav-link"><?php echo e(__lang('statement-of-result')); ?></a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <?php $__env->startSection('title-crumb'); ?>
                <div class="section-header">
                    <?php if (! empty(trim($__env->yieldContent('innerTitle')))): ?>
                        <h1><?php echo $__env->yieldContent('innerTitle'); ?></h1>
                    <?php endif; ?>
                    <div class="section-header-breadcrumb">
                        <?php echo $__env->yieldContent('breadcrumb'); ?>
                    </div>
                </div>
                <?php echo $__env->yieldSection(); ?>

                <div class="section-body">
                    <?php if(count($errors) > 0): ?>
                        <div class="alert alert-danger alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>


                    <?php $__currentLoopData = ['danger', 'warning', 'success', 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(Session::has('alert-' . $msg)): ?>

                            <div class="alert alert-<?php echo e($msg); ?> alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    <?php echo clean(Session::get('alert-' . $msg)); ?>

                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(Session::has('flash_message')): ?>
                        <div class="alert alert-success alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                                <?php echo clean(Session::get('flash_message')); ?>

                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if(isset($flash_message)): ?>
                        <div class="alert alert-success alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                                <?php echo clean($flash_message); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </section>
        </div>
        <footer class="main-footer">
            <div class="footer-left">
                <?php echo e(__lang('copyright')); ?> &copy; <?php echo e(date('Y')); ?>  <?php echo e(setting('general_site_name')); ?>

            </div>
            <div class="footer-right">

            </div>
        </footer>
    </div>
</div>
<div class="modal fade" id="generalModal" tabindex="-1" role="dialog"  >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="generalModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"  id="genmodalinfo">
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="generalLargeModal" tabindex="-1" role="dialog"  >
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="generalLargeModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"  id="genLargemodalinfo">
            </div>

        </div>
    </div>
</div>

<!-- END SIMPLE MODAL MARKUP -->
<script>
    function openModal(title,url){
        $('#genmodalinfo').html(' <img  src="<?php echo e(asset('img/ajax-loader.gif')); ?>');
        $('#generalModalLabel').text(title);
        $('#genmodalinfo').load(url);
        $('#generalModal').modal();
    }
    function openLargeModal(title,url){
        $('#genLargemodalinfo').html(' <img  src="<?php echo e(asset('img/ajax-loader.gif')); ?>');
        $('#generalLargeModalLabel').text(title);
        $('#genLargemodalinfo').load(url);
        $('#generalLargeModal').modal();
    }
    function openPopup(url){
        window.open(url, "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
        return false;
    }
</script>

<!-- General JS Scripts -->
<script src="<?php echo e(asset('client/themes/admin/assets/modules/jquery.min.js')); ?>"></script>

<script src="<?php echo e(asset('client/themes/admin/assets/modules/popper.js')); ?>"></script>
<script src="<?php echo e(asset('client/themes/admin/assets/modules/tooltip.js')); ?>"></script>

<script src="<?php echo e(asset('client/themes/admin/assets/modules/bootstrap/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('client/themes/admin/assets/modules/nicescroll/jquery.nicescroll.min.js')); ?>"></script>
<script src="<?php echo e(asset('client/themes/admin/assets/modules/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('client/themes/admin/assets/js/stisla.js')); ?>"></script>

<!-- JS Libraies -->

<!-- Page Specific JS File -->

<!-- Template JS File -->
<script src="<?php echo e(asset('client/themes/admin/assets/js/scripts.js')); ?>"></script>
<script src="<?php echo e(asset('client/themes/admin/assets/js/custom.js')); ?>"></script>
<script src="<?php echo e(asset('client/vendor/select2/js/select2.min.js')); ?>"></script>

<script src="<?php echo e(asset('client/app/lib.js')); ?>"></script>
<?php echo setting('general_foot_scripts'); ?>

<?php echo $__env->yieldContent('footer'); ?>
</body>
</html>
<?php /**PATH C:\Users\DHRUVESH TRIPATHI\Videos\base_file_aiipl\resources\views/layouts/student.blade.php ENDPATH**/ ?>