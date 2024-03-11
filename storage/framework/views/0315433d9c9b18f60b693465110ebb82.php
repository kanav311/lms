<!DOCTYPE html>
<html <?php echo langMeta(); ?>  >
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?php echo $__env->yieldContent('pageTitle',isset($pageTitle)? $pageTitle:__('default.admin')); ?> - <?php echo e(env('APP_NAME')); ?></title>

    <?php if(!empty(setting('image_icon'))): ?>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset(setting('image_icon'))); ?>">
    <?php endif; ?>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?php echo e(asset('client/themes/admin/assets/modules/bootstrap/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/themes/admin/assets/modules/fontawesome/css/all.min.css')); ?>">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo e(asset('client/themes/admin/assets/modules/jqvmap/dist/jqvmap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/themes/admin/assets/modules/weather-icon/css/weather-icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/themes/admin/assets/modules/weather-icon/css/weather-icons-wind.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/themes/admin/assets/modules/summernote/summernote-bs4.css')); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('client/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.css')); ?>" />

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('client/themes/admin/assets/css/style.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('client/themes/admin/assets/css/components.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/themes/admin/assets/css/custom.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/css/admin.css')); ?>">
    <script src="<?php echo e(asset('client/themes/admin/assets/modules/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('client/vendor/jquery-ui-1.11.4/jquery-ui.min.js')); ?>"></script>
    <link href="<?php echo e(asset('client/vendor/select2/css/select2.min.css')); ?>" rel="stylesheet" />
    <script src="<?php echo e(asset('client/vendor/select2/js/select2.min.js')); ?>"></script>

    <script src="<?php echo e(asset('client/app/lib.js')); ?>"></script>

    <?php if(!empty(setting('dashboard_color'))): ?>
        <?php echo $__env->make('partials.dashboard-css',['color'=>setting('dashboard_color')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php echo $__env->yieldContent('header'); ?>

</head>

<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1" id="content">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <?php if (! empty(trim($__env->yieldContent('search-form')))): ?>
                <?php echo $__env->yieldContent('search-form'); ?>
            <?php else: ?>
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
            <?php endif; ?>



            <ul class="navbar-nav navbar-right">

                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <?php if(!empty(Auth::user()->picture) && file_exists(Auth::user()->picture)): ?>
                        <img alt="image" src="<?php echo e(asset(Auth::user()->picture)); ?>" class="rounded-circle mr-1">
                        <?php else: ?>
                            <img alt="image" src="<?php echo e(asset('client/themes/admin/assets/img/avatar/avatar-1.png')); ?>" class="rounded-circle mr-1">
                        <?php endif; ?>
                        <div class="d-sm-none d-lg-inline-block"><?php echo app('translator')->get('default.hi'); ?>, <?php echo e(Auth()->user()->name); ?></div></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-title"><?php echo app('translator')->get('default.account'); ?></div>
                        <a href="<?php echo route('admin.account.profile'); ?>" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> <?php echo app('translator')->get('default.profile'); ?>
                        </a>
                        <a href="<?php echo route('admin.account.email'); ?>" class="dropdown-item has-icon">
                            <i class="fas fa-envelope"></i> <?php echo app('translator')->get('default.change-email'); ?>
                        </a>
                        <a href="<?php echo route('admin.account.password'); ?>" class="dropdown-item has-icon">
                            <i class="fas fa-unlock"></i> <?php echo app('translator')->get('default.change-password'); ?>
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
        <div class="main-sidebar sidebar-style-2">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href="<?php echo e(url('/')); ?>">
                        <?php echo e(env('APP_NAME')); ?>

                    </a>
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="<?php echo e(url('/')); ?>">

                            <?php echo e(substr(env('APP_NAME'),0,2)); ?>


                    </a>
                </div>
                <ul class="sidebar-menu">
                    <li class="menu-header"><?php echo app('translator')->get('default.menu'); ?></li>
                    <li><a href="<?php echo route('admin.dashboard'); ?>" class="nav-link"><i class="fas fa-fire"></i><span><?php echo app('translator')->get('default.dashboard'); ?></span></a></li>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access-group','course')): ?>
                    <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-book"></i><span><?php echo e(__lang('courses-sessions')); ?></span></a>
                        <ul class="dropdown-menu">

                            <li class="dropdown">
                                <a href="#" class="nav-link has-dropdown"><span><?php echo e(__lang('add-new')); ?></span></a>
                                <ul class="dropdown-menu">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','add_course')): ?>
                                    <li><a class="nav-link" href="<?php echo route('admin.session.addcourse'); ?>"><?php echo e(__lang('online-course')); ?></a></li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','add_session')): ?>
                                    <li><a class="nav-link" href="<?php echo e(route('admin.student.addsession',['type'=>'s'])); ?>"><?php echo e(__lang('training-session')); ?></a></li>
                                    <li><a class="nav-link" href="<?php echo e(route('admin.student.addsession',['type'=>'b'])); ?>"><?php echo e(__lang('training-online')); ?></a></li>
                                    <?php endif; ?>
                                </ul>
                            </li>

                            <li ><a class="nav-link" href="<?php echo e(route('admin.student.sessions')); ?>"><?php echo e(__lang('all-courses-session')); ?> </a></li>
                            <li><a class="nav-link" href="<?php echo e(route('admin.session.groups')); ?>"><?php echo e(__lang('manage-categories')); ?></a></li>
                              <li><a class="nav-link" href="<?php echo e(route('admin.student.invoices')); ?>"><?php echo e(__lang('invoices')); ?></a></li>

                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access-group','student')): ?>
                    <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span><?= __lang('students') ?></span></a>
                        <ul class="dropdown-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','add_student')): ?><li ><a class="nav-link" href="<?php echo route('admin.student.add'); ?>"><?php echo e(__lang('add-student')); ?></a></li><?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_students')): ?><li ><a class="nav-link" href="<?php echo route('admin.student.index'); ?>"><?php echo e(__lang('all-students')); ?></a></li><?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_students')): ?><li ><a class="nav-link" href="<?php echo route('admin.student.active'); ?>"><?php echo e(__lang('active-students')); ?></a></li><?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','bulk_enroll')): ?><li ><a class="nav-link" href="<?php echo route('admin.student.massenroll'); ?>"><?php echo e(__lang('bulk-enroll')); ?></a></li><?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','export_student')): ?><li ><a class="nav-link" href="<?php echo route('admin.student.import'); ?>"><?php echo e(__lang('import-export')); ?></a></li><?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','message_students')): ?><li ><a class="nav-link" href="<?php echo route('admin.student.mailsession'); ?>"><?php echo e(__lang('message-students')); ?></a></li><?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_students')): ?><li ><a class="nav-link" href="<?php echo route('admin.student.code'); ?>"><?php echo e(__lang('verify-code')); ?></a></li><?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access-group','classes')): ?>
                    <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-chalkboard-teacher "></i><span><?php echo e(__lang('classes')); ?></span></a>
                        <ul class="dropdown-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','add_class')): ?><li ><a class="nav-link" href="<?php echo route('admin.lesson.add'); ?>"><?php echo e(__lang('add-class')); ?></a></li><?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_classes')): ?><li ><a class="nav-link" href="<?php echo route('admin.lesson.index'); ?>"><?php echo e(__lang('all-classes')); ?></a></li><?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_class_groups')): ?><li ><a class="nav-link" href="<?php echo route('admin.lesson.groups'); ?>"><?php echo e(__lang('manage-class-groups')); ?></a></li><?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access-group','video')): ?>
                    <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-video"></i><span><?php echo e(__lang('video-library')); ?></span></a>
                        <ul class="dropdown-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','add_video')): ?><li ><a class="nav-link" href="<?php echo route('admin.video.add'); ?>"><?php echo e(__lang('add-video')); ?></a></li><?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_videos')): ?><li ><a class="nav-link" href="<?php echo route('admin.video.index'); ?>"><?php echo e(__lang('all-videos')); ?></a></li><?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_video_space')): ?><li ><a class="nav-link" href="<?php echo route('admin.video.disk'); ?>"><?php echo e(__lang('disk-space-usage')); ?></a></li><?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                   <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access-group','attendance')): ?>
                    <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-table"></i><span><?php echo e(__lang('attendance')); ?></span></a>
                        <ul class="dropdown-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','set_attendance')): ?><li ><a class="nav-link" href="<?php echo route('admin.student.attendance'); ?>"><?php echo e(__lang('attendance')); ?></a></li><?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','set_bulk_attendance')): ?><li ><a class="nav-link" href="<?php echo route('admin.student.attendancebulk'); ?>"><?php echo e(__lang('attendance')); ?> (<?php echo e(__lang('bulk')); ?>)</a></li><?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','set_import_attendance')): ?><li ><a class="nav-link" href="<?php echo route('admin.student.attendanceimport'); ?>"><?php echo e(__lang('attendance')); ?> (<?php echo e(__lang('import')); ?>)</a></li><?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','create_certificate_list')): ?><li ><a class="nav-link" href="<?php echo route('admin.student.certificatelist'); ?>"><?php echo e(__lang('certificate-list')); ?></a></li><?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','set_attendance_dates')): ?><li ><a class="nav-link" href="<?php echo route('admin.student.attendancedate'); ?>"><?php echo e(__lang('attendance-dates')); ?></a></li><?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access-group','homework')): ?>
                    <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-edit"></i><span><?php echo e(__lang('homework')); ?></span></a>
                        <ul class="dropdown-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','add_homework')): ?><li ><a class="nav-link" href="<?php echo route('admin.assignment.add'); ?>"><?php echo e(__lang('add-homework')); ?></a></li><?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_homework_list')): ?><li ><a class="nav-link" href="<?php echo route('admin.assignment.index'); ?>"><?php echo e(__lang('view-all')); ?></a></li><?php endif; ?>

                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access-group','revision_notes')): ?>
                    <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-list-alt"></i><span><?php echo e(__lang('revision-notes')); ?></span></a>
                        <ul class="dropdown-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','add_note')): ?><li ><a class="nav-link" href="<?php echo route('admin.homework.add'); ?>"><?php echo e(__lang('add-note')); ?></a></li><?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_notes')): ?><li ><a class="nav-link" href="<?php echo route('admin.homework.index'); ?>"><?php echo e(__lang('view-archive')); ?></a></li><?php endif; ?>

                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access-group','downloads')): ?>
                    <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-download"></i><span><?php echo e(__lang('downloads')); ?></span></a>
                        <ul class="dropdown-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','add_download')): ?><li ><a class="nav-link" href="<?php echo route('admin.download.add'); ?>"><?php echo e(__lang('create-download')); ?></a></li><?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_downloads')): ?><li ><a class="nav-link" href="<?php echo route('admin.download.index'); ?>"><?php echo e(__lang('all-downloads')); ?></a></li><?php endif; ?>
                        </ul>
                    </li>
                        <?php endif; ?>
                   <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access-group','discussions')): ?>
                    <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-comments"></i><span><?php echo e(__lang('discussions')); ?></span></a>
                        <ul class="dropdown-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_discussions')): ?><li ><a class="nav-link" href="<?php echo route('admin.discuss.index'); ?>"><?php echo e(__lang('instructor-chat')); ?></a></li><?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_forum_topics')): ?><li ><a class="nav-link" href="<?php echo route('admin.forum.index'); ?>"><?php echo e(__lang('student-forum')); ?></a></li><?php endif; ?>
                        </ul>
                    </li>
                        <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access-group','tests')): ?>
                    <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-check-circle"></i><span><?php echo e(__lang('tests')); ?></span></a>
                        <ul class="dropdown-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_tests')): ?><li ><a class="nav-link" href="<?php echo route('admin.test.add'); ?>"><?php echo e(__lang('add-test')); ?></a></li><?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','add_test')): ?><li ><a class="nav-link" href="<?php echo route('admin.test.index'); ?>"><?php echo e(__lang('all-tests')); ?></a></li><?php endif; ?>
                        </ul>
                    </li>
                        <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access-group','survey')): ?>
                    <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-flag-checkered"></i><span><?php echo e(__lang('surveys')); ?></span></a>
                        <ul class="dropdown-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','add_survey')): ?><li ><a class="nav-link" href="<?php echo route('admin.survey.add'); ?>"><?php echo e(__lang('add-survey')); ?></a></li><?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_surveys')): ?><li ><a class="nav-link" href="<?php echo route('admin.survey.index'); ?>"><?php echo e(__lang('all-surveys')); ?></a></li><?php endif; ?>
                        </ul>
                    </li>
                        <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access-group','certificates')): ?>
                    <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-pdf"></i><span><?php echo e(__lang('certificates')); ?></span></a>
                        <ul class="dropdown-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','add_certificate')): ?><li ><a class="nav-link" href="<?php echo route('admin.certificate.add'); ?>"><?php echo e(__lang('create-certificate')); ?></a></li><?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_certificates')): ?><li ><a class="nav-link" href="<?php echo route('admin.certificate.index'); ?>"><?php echo e(__lang('manage-certificates')); ?></a></li><?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_certificates')): ?><li ><a class="nav-link" href="<?php echo route('admin.certificate.track'); ?>"><?php echo e(__lang('track-certificates')); ?></a></li><?php endif; ?>
                        </ul>
                    </li>
                            <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access-group','reports')): ?>
                    <li class="dropdown">
                        <a href="<?php echo route('admin.report.index'); ?>" class="nav-link"><i class="fas fa-chart-bar"></i><span><?php echo e(__lang('reports')); ?></span></a>

                    </li>
                            <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access-group','blog')): ?>
                    <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-pencil-alt"></i><span><?php echo e(__lang('blog')); ?></span></a>
                        <ul class="dropdown-menu">

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_blog')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('admin.blog-posts.index')); ?>" class="nav-link"><?php echo app('translator')->get('default.manage-posts'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','add_blog')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('admin.blog-posts.create')); ?>" class="nav-link"><?php echo app('translator')->get('default.create-post'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','manage_blog_categories')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('admin.blog-categories.index')); ?>" class="nav-link"><?php echo app('translator')->get('default.manage-categories'); ?></a>
                                    </li>
                                <?php endif; ?>

                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access-group','files')): ?>
                        <li class="dropdown">
                            <a  onclick="window.open('<?php echo e(route('admin.filemanager.home')); ?>', '<?php echo e(__lang('filemanager')); ?>', 'width=1100, height=530',true);" href="javascript:;" href="#" class="nav-link"><i class="fas fa-file-archive"></i><span><?php echo e(__lang('filemanager')); ?></span></a>

                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access-group','articles')): ?>
                        <li class="dropdown">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-pencil-ruler"></i><span><?php echo e(__lang('articles')); ?></span></a>
                            <ul class="dropdown-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','add_article')): ?><li ><a class="nav-link" href="<?php echo e(route('admin.articles.create')); ?>"><?php echo e(__lang('add-articles')); ?></a></li><?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_articles')): ?><li ><a class="nav-link" href="<?php echo e(route('admin.articles.index')); ?>"><?php echo e(__lang('view-articles')); ?></a></li><?php endif; ?>

                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access-group','settings')): ?>
                        <li class="dropdown">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-cogs"></i><span><?php echo e(__lang('settings')); ?></span></a>
                            <ul class="dropdown-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','edit_site_settings')): ?><li ><a class="nav-link" href="<?php echo route('admin.setting.index'); ?>"><?php echo e(__lang('site-settings')); ?></a></li><?php endif; ?>
                               <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','edit_registration_field')): ?><li ><a class="nav-link" href="<?php echo route('admin.setting.fields'); ?>"><?php echo e(__lang('custom-student-fields')); ?></a></li><?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','edit_site_settings')): ?><li ><a class="nav-link" href="<?php echo route('admin.setting.language'); ?>"><?php echo e(__lang('language')); ?></a></li><?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_themes')): ?><li ><a class="nav-link" href="<?php echo route('admin.templates'); ?>"><?php echo e(__lang('site-theme')); ?></a></li><?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_payment_methods')): ?><li ><a class="nav-link" href="<?php echo route('admin.payment-gateways'); ?>"><?php echo e(__lang('payment-methods')); ?></a></li><?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_coupons')): ?><li ><a class="nav-link" href="<?php echo route('admin.payment.coupons'); ?>"><?php echo e(__lang('coupons')); ?></a></li><?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','manage_currencies')): ?><li ><a class="nav-link" href="<?php echo route('admin.setting.currencies'); ?>"><?php echo e(__lang('currencies')); ?></a></li><?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','configure_sms_gateways')): ?><li ><a class="nav-link" href="<?php echo route('admin.smsgateway.index'); ?>"><?php echo e(__lang('sms-setup')); ?></a></li><?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_roles')): ?><li ><a class="nav-link" href="<?php echo route('admin.roles.index'); ?>"><?php echo e(__lang('roles')); ?></a></li><?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_admins')): ?><li ><a class="nav-link" href="<?php echo route('admin.admins.index'); ?>"><?php echo e(__lang('administrators-instructors')); ?></a></li><?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_test_grades')): ?><li ><a class="nav-link" href="<?php echo route('admin.setting.testgrades'); ?>"><?php echo e(__lang('grades')); ?></a></li><?php endif; ?>
                                   <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_widgets')): ?><li ><a class="nav-link" href="<?php echo route('admin.widget.index'); ?>"><?php echo e(__lang('homepage-widgets')); ?></a></li><?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','edit_site_settings')): ?>
                                    <li>
                                        <a href="<?php echo e(route('admin.frontend')); ?>" class="nav-link"><?php echo app('translator')->get('default.disable-frontend'); ?></a>
                                    </li>
                                        <li>
                                            <a href="<?php echo e(route('admin.dashboard-theme')); ?>" class="nav-link"><?php echo app('translator')->get('default.dashboard-theme'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <li class="dropdown">
                                        <a href="#" class="nav-link has-dropdown"><span><?php echo app('translator')->get('default.menus'); ?></span></a>
                                        <ul class="dropdown-menu">

                                                <li><a class="nav-link" href="<?php echo e(route('admin.menus.header')); ?>"><?php echo app('translator')->get('default.header-menu'); ?></a></li>

                                                <li><a class="nav-link" href="<?php echo e(route('admin.menus.footer')); ?>"><?php echo app('translator')->get('default.footer-menu'); ?></a></li>

                                        </ul>
                                    </li>

                                   <li class="dropdown">
                                        <a href="#" class="nav-link has-dropdown"><span><?php echo e(__lang('notification-messages')); ?></span></a>
                                        <ul class="dropdown-menu">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_email_notifications')): ?>
                                                <li><a class="nav-link" href="<?php echo route('admin.messages.emails'); ?>"><?php echo e(__lang('email-notifications')); ?></a></li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_sms_notifications')): ?>
                                                <li><a class="nav-link" href="<?php echo route('admin.messages.sms'); ?>"><?php echo e(__lang('sms-notifications')); ?></a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                    <?php if(!saas()): ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','upgrade_database')): ?><li ><a class="nav-link" href="<?php echo route('admin.setting.migrate'); ?>"><?php echo e(__lang('update')); ?></a></li><?php endif; ?>
                                    <?php endif; ?>

                            </ul>
                        </li>
                    <?php endif; ?>



                </ul>

                <?php if(config('app.credits')==true): ?>
                    <?php if(saas()): ?>
                        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                            <a target="_blank" href="https://aiipltech.com/" class="btn btn-primary btn-lg btn-block btn-icon-split">
                                <i class="fa fa-question-circle"></i> <?php echo app('translator')->get('default.help'); ?>
                            </a>
                        </div>
                    <?php else: ?>
                <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                    <a target="_blank" href="https://aiipltech.com/" class="btn btn-primary btn-lg btn-block btn-icon-split">
                        <i class="fa fa-question-circle"></i> <?php echo app('translator')->get('default.help'); ?>
                    </a>
                </div>
                    <?php endif; ?>
                <?php endif; ?>


            </aside>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <?php if(isset($pageTitle)): ?>
                        <h1><?php echo e($pageTitle); ?></h1>
                        <?php endif; ?>

                    <?php if (! empty(trim($__env->yieldContent('innerTitle')))): ?>
                        <h1><?php echo $__env->yieldContent('innerTitle'); ?></h1>
                    <?php endif; ?>
                    <?php if (! empty(trim($__env->yieldContent('breadcrumb')))): ?>
                        <div class="section-header-breadcrumb">

                            <?php echo $__env->yieldContent('breadcrumb'); ?>


                        </div>
                    <?php endif; ?>


                </div>

                <div class="section-body" id="layout_content">


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
                <?php echo e(__lang('copyright')); ?> &copy; <?php echo e(date('Y')); ?>    <a href="<?php echo e(config('app.author_url')); ?>"><?php echo e(config('app.app_author')); ?></a>
            </div>
            <div class="footer-right">

            </div>
        </footer>
    </div>
</div>

<!-- General JS Scripts -->

<script src="<?php echo e(asset('client/themes/admin/assets/modules/popper.js')); ?>"></script>
<script src="<?php echo e(asset('client/themes/admin/assets/modules/tooltip.js')); ?>"></script>
<script src="<?php echo e(asset('client/themes/admin/assets/modules/bootstrap/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('client/themes/admin/assets/modules/nicescroll/jquery.nicescroll.min.js')); ?>"></script>
<script src="<?php echo e(asset('client/themes/admin/assets/modules/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('client/themes/admin/assets/js/stisla.js')); ?>"></script>

<!-- JS Libraies -->
<script src="<?php echo e(asset('client/themes/admin/assets/modules/simple-weather/jquery.simpleWeather.min.js')); ?>"></script>
<script src="<?php echo e(asset('client/themes/admin/assets/modules/chart.min.js')); ?>"></script>
<script src="<?php echo e(asset('client/themes/admin/assets/modules/jqvmap/dist/jquery.vmap.min.js')); ?>"></script>
<script src="<?php echo e(asset('client/themes/admin/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js')); ?>"></script>
<script src="<?php echo e(asset('client/themes/admin/assets/modules/summernote/summernote-bs4.js')); ?>"></script>
<script src="<?php echo e(asset('client/themes/admin/assets/modules/chocolat/dist/js/jquery.chocolat.min.js')); ?>"></script>



<!-- Template JS File -->
<script src="<?php echo e(asset('client/themes/admin/assets/js/scripts.js')); ?>"></script>
<script src="<?php echo e(asset('client/themes/admin/assets/js/custom.js')); ?>"></script>

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

<?php echo $__env->yieldContent('footer'); ?>

</body>
</html>
<?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\resources\views/layouts/admin.blade.php ENDPATH**/ ?>