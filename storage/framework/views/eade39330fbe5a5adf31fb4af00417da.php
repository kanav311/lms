<!DOCTYPE html>
<html class="no-js" lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title><?php echo $__env->yieldContent('page-title'); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('meta-description'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php if(!empty(setting('image_icon'))): ?>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset(setting('image_icon'))); ?>">
    <?php endif; ?>

    <!-- Web Font -->
    <link  href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="<?php echo e(tasset('assets/css/bootstrap.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(tasset('assets/css/LineIcons.2.0.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(tasset('assets/css/animate.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(tasset('assets/css/tiny-slider.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(tasset('assets/css/glightbox.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(tasset('assets/css/main')); ?>" />

    <link rel="stylesheet" href="<?php echo e(tasset('assets/css/fontawesome-all.min.css')); ?>">

    <?php echo $__env->yieldContent('header'); ?>
    <?php echo setting('general_header_scripts'); ?>

    <?php if(optionActive('top-bar')): ?>
        <style>
            <?php if(!empty(toption('top-bar','bg_color'))): ?>
                .header .toolbar-area{
                background-color: #<?php echo e(toption('top-bar','bg_color')); ?>;
            }
            <?php endif; ?>

                     <?php if(!empty(toption('top-bar','font_color'))): ?>
              .header .toolbar-area .toolbar-social ul li .title,.header .toolbar-area .toolbar-social ul li a,.header .toolbar-login a {
                color: #<?php echo e(toption('top-bar','font_color')); ?>;
            }
            <?php endif; ?>



        </style>
    <?php endif; ?>


    <?php if(optionActive('navigation')): ?>
        <style>
            <?php if(!empty(toption('navigation','bg_color'))): ?>
                header.header,.navbar-area.sticky,.navbar-collapse,.navbar-nav .nav-item .sub-menu{
                background-color: #<?php echo e(toption('navigation','bg_color')); ?>;
            }
            <?php endif; ?>

            <?php if(!empty(toption('navigation','font_color'))): ?>
                .navbar-nav .nav-item a,.sticky .navbar .navbar-nav .nav-item a,.header .search-form .btn-outline-success,.sticky .navbar .navbar-nav .nav-item a,sticky .navbar .navbar-nav .nav-item a:hover,.navbar-nav .nav-item .sub-menu .nav-item a{
                color: #<?php echo e(toption('navigation','font_color')); ?>;
                }
            .mobile-menu-btn .toggler-icon,.sticky .navbar .mobile-menu-btn .toggler-icon {
                background-color: #<?php echo e(toption('navigation','font_color')); ?>;
            }
            <?php endif; ?>



        </style>
    <?php endif; ?>
    <style>
        <?php if(optionActive('footer')): ?>

                    <?php if(!empty(toption('footer','image'))): ?>

                        .footer{
                            background: url(<?php echo e(toption('footer','image')); ?>);
                        }

                    <?php endif; ?>

                    <?php if(!empty(toption('footer','bg_color'))): ?>

                        .footer{
                        background-color: #<?php echo e(toption('footer','bg_color')); ?>;
                        }

                    <?php endif; ?>

                    <?php if(!empty(toption('footer','font_color'))): ?>
                        .footer,.footer a,.footer .recent-blog ul li a,.footer .f-link ul li a,.footer .single-footer h3{
                            color: #<?php echo e(toption('footer','font_color')); ?>;
                        }
                    <?php endif; ?>

                       <?php if(!empty(toption('footer','credits_bg_color'))): ?>

                            .footer .footer-bottom{
                                background-color: #<?php echo e(toption('footer','credits_bg_color')); ?>;
                            }

                        <?php endif; ?>

                      <?php if(!empty(toption('footer','credits_font_color'))): ?>
                        .footer .footer-bottom .inner p{
                        color: #<?php echo e(toption('footer','credits_font_color')); ?>;
                        }
                    <?php endif; ?>

        <?php endif; ?>



        <?php if(optionActive('page-title')): ?>
                <?php if(!empty(toption('page-title','bg_color'))): ?>
                    .breadcrumbs{
                    background-color: #<?php echo e(toption('page-title','bg_color')); ?> ;
                }
                <?php endif; ?>

                <?php if(!empty(toption('page-title','font_color'))): ?>
                            .breadcrumbs .breadcrumbs-content .page-title,.breadcrumbs .breadcrumb-nav li, .breadcrumbs .breadcrumb-nav li a {
                    color: #<?php echo e(toption('page-title','font_color')); ?>;
                }
                <?php endif; ?>

        <?php endif; ?>
    </style>



</head>

<body>
<!--[if lte IE 9]>
<p class="browserupgrade">
    You are using an <strong>outdated</strong> browser. Please
    <a href="https://browsehappy.com/">upgrade your browser</a> to improve
    your experience and security.
</p>
<![endif]-->

<!-- Preloader -->
<div class="preloader">
    <div class="preloader-inner">
        <div class="preloader-icon">
            <span></span>
            <span></span>
        </div>
    </div>
</div>
<!-- /End Preloader -->

<!-- Start Header Area -->
<header class="header navbar-area">
    <?php if(optionActive('top-bar')): ?>
    <!-- Toolbar Start -->
    <div class="toolbar-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6 col-12">
                    <div class="toolbar-social">
                        <ul>
                            <?php if(getCart()->getTotalItems()==0): ?>
                                        <li><span class="title"><?php echo e(__t('follow-us-on')); ?> : </span></li>

                                        <?php if(!empty(toption('top-bar','social_facebook'))): ?>
                                        <li><a href="<?php echo e(toption('top-bar','social_facebook')); ?>"><i class="lni lni-facebook-original"></i></a></li>
                                        <?php endif; ?>
                                        <?php if(!empty(toption('top-bar','social_twitter'))): ?>
                                        <li><a href="<?php echo e(toption('top-bar','social_twitter')); ?>"><i class="lni lni-twitter-original"></i></a></li>
                                        <?php endif; ?>
                                        <?php if(!empty(toption('top-bar','social_instagram'))): ?>
                                        <li><a href="<?php echo e(toption('top-bar','social_instagram')); ?>"><i class="lni lni-instagram"></i></a></li>
                                        <?php endif; ?>
                                        <?php if(!empty(toption('top-bar','social_linkedin'))): ?>
                                        <li><a href="<?php echo e(toption('top-bar','social_linkedin')); ?>"><i class="lni lni-linkedin-original"></i></a></li>
                                        <?php endif; ?>
                                        <?php if(!empty(toption('top-bar','social_youtube'))): ?>
                                        <li><a href="<?php echo e(toption('top-bar','social_youtube')); ?>"><i class="lni lni-youtube"></i></a></li>
                                        <?php endif; ?>
                            <?php else: ?>

                                <li><a href="<?php echo e(route('cart')); ?>"><i class="lni lni-cart"></i> <?php echo e(__lang('your-cart')); ?><?php if(getCart()->getTotalItems()>0): ?> (<?php echo e(getCart()->getTotalItems()); ?>) <?php endif; ?></a></li>
                            <?php endif; ?>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="toolbar-login">
                        <div class="button">
                            <?php if(auth()->guard()->guest()): ?>
                                <a href="<?php echo e(route('register')); ?>"><?php echo e(__lang('register')); ?></a>
                                <a href="<?php echo e(route('login')); ?>" class="btn"><?php echo app('translator')->get('default.login'); ?></a>
                            <?php else: ?>
                                <a  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" href="<?php echo e(route('logout')); ?>" ><?php echo e(__lang('logout')); ?></a>
                                <a href="<?php echo e(route('home')); ?>" class="btn"><?php echo app('translator')->get('default.my-account'); ?></a>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"  class="int_hide  hidden">
            <?php echo csrf_field(); ?>
        </form>
    <!-- Toolbar End -->
    <?php endif; ?>

    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="nav-inner">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                            <?php if(!empty(setting('image_logo'))): ?>
                                <img src="<?php echo e(asset(setting('image_logo'))); ?>" >
                            <?php else: ?>
                                <?php echo e(setting('general_site_name')); ?>

                            <?php endif; ?>

                        </a>
                        <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ms-auto">

                                <?php $__currentLoopData = headerMenu(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <li class="nav-item">
                                        <a <?php if($menu['new_window']): ?> target="_blank" <?php endif; ?> <?php if($menu['children']): ?> class="page-scroll <?php if($menu['url']==request()->url() || urlInMenu(request()->url(),$menu)): ?> active <?php endif; ?> dd-menu collapsed" href="javascript:void(0)"    data-bs-toggle="collapse" data-bs-target="#submenu-1-<?php echo e($key); ?>"
                                           aria-controls="navbarSupportedContent" aria-expanded="false"
                                           aria-label="Toggle navigation" <?php else: ?> <?php if($menu['url']==request()->url()): ?> class="active" <?php endif; ?>  href="<?php echo e($menu['url']); ?>" <?php endif; ?> ><?php echo e($menu['label']); ?></a>
                                        <?php if($menu['children']): ?>
                                            <ul  class="sub-menu collapse" id="submenu-1-<?php echo e($key); ?>">
                                                <?php $__currentLoopData = $menu['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childMenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="nav-item" ><a <?php if($childMenu['new_window']): ?> target="_blank" <?php endif; ?>  href="<?php echo e($childMenu['url']); ?>" ><?php echo e($childMenu['label']); ?></a></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </ul>
                            <?php if(toption('navigation','search_form')==1): ?>
                            <form action="<?php echo e(route('courses')); ?>"  class="d-flex search-form">
                                <input class="form-control me-2" name="filter" type="search" placeholder="<?php echo e(__lang('search-courses')); ?>"
                                       aria-label="<?php echo e(__lang('search-courses')); ?>">
                                <button class="btn btn-outline-success" type="submit"><i
                                        class="lni lni-search-alt"></i></button>
                            </form>
                            <?php endif; ?>
                        </div> <!-- navbar collapse -->
                    </nav> <!-- navbar -->
                </div>
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</header>
<!-- End Header Area -->

<?php if (! empty(trim($__env->yieldContent('inline-title')))): ?>
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs overlay"
         <?php if(!empty(toption('page-title','image'))): ?>
             style="background-image: url(<?php echo e(asset(toption('page-title','image'))); ?>);"
         <?php elseif(empty(toption('page-title','bg_color'))): ?>
            style="background-image: url(<?php echo e(tasset('assets/images/demo/breadcrumb-bg.jpg')); ?>);"
        <?php endif; ?>
    >
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title"><?php echo $__env->yieldContent('inline-title'); ?></h1>
                    </div>
                    <?php if (! empty(trim($__env->yieldContent('crumb')))): ?>
                    <ul class="breadcrumb-nav">
                        <li><a href="<?php echo route('homepage'); ?>"><?php echo app('translator')->get('default.home'); ?></a></li>
                        <?php echo $__env->yieldContent('crumb'); ?>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
<?php endif; ?>

<?php echo $__env->make('partials.flash_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('content'); ?>


<!-- Start Footer Area -->
<footer class="footer">
    <!-- Start Middle Top -->
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="f-about single-footer">
                        <?php if(!empty(setting('image_logo'))): ?>
                        <div class="logo">
                            <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset(setting('image_logo'))); ?>" ></a>
                        </div>
                        <?php endif; ?>
                        <p><?php echo e(toption('footer','text')); ?></p>
                        <div class="footer-social">
                            <ul>
                                <?php if(!empty(toption('footer','social_facebook'))): ?>
                                <li><a href="<?php echo e(toption('footer','social_facebook')); ?>"><i class="lni lni-facebook-original"></i></a></li>
                                <?php endif; ?>
                                <?php if(!empty(toption('footer','social_twitter'))): ?>
                                <li><a href="<?php echo e(toption('footer','social_twitter')); ?>"><i class="lni lni-twitter-original"></i></a></li>
                                <?php endif; ?>
                                <?php if(!empty(toption('footer','social_instagram'))): ?>
                                    <li><a href="<?php echo e(toption('footer','social_instagram')); ?>"><i class="lni lni-instagram"></i></a></li>
                                <?php endif; ?>
                                <?php if(!empty(toption('footer','social_linkedin'))): ?>
                                <li><a href="<?php echo e(toption('footer','social_linkedin')); ?>"><i class="lni lni-linkedin-original"></i></a></li>
                                <?php endif; ?>
                                <?php if(!empty(toption('footer','social_youtube'))): ?>
                                <li><a href="<?php echo e(toption('footer','social_youtube')); ?>"><i class="lni lni-youtube"></i></a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <?php if(toption('footer','blog')==1): ?>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer sm-custom-border recent-blog">
                        <h3><?php echo e(__t('latest-news')); ?></h3>

                        <ul>
                            <?php $__currentLoopData = getLatestBlogPosts(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a <?php if(empty($post->cover_photo)): ?> style="padding-left: 0px" <?php endif; ?> href="<?php echo e(route('blog.post',['blogPost'=>$post->id,'slug'=>safeUrl($post->title)])); ?>">
                                    <?php if(!empty($post->cover_photo)): ?>
                                        <img src="<?php echo e(resizeImage($post->cover_photo,100,100)); ?>" alt="">
                                    <?php endif; ?>
                                    <?php echo e($post->title); ?>

                                </a>
                                <span  <?php if(empty($post->cover_photo)): ?> style="padding-left: 0px" <?php endif; ?>  class="date"><i class="lni lni-calendar"></i><?php echo e(\Carbon\Carbon::parse($post->publish_date)->format('M d, Y')); ?></span>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                        </ul>

                    </div>
                    <!-- End Single Widget -->
                </div>
                <?php endif; ?>
                <?php $__currentLoopData = footerMenu(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer sm-custom-border f-link">
                        <h3><?php echo e($menu['label']); ?></h3>
                        <ul>
                            <?php if($menu['children'] && is_array($menu['children'])): ?>
                            <?php $__currentLoopData = $menu['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childMenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a  <?php if($childMenu['new_window']): ?> target="_blank" <?php endif; ?>  href="<?php echo e($childMenu['url']); ?>"><?php echo e($childMenu['label']); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                        </ul>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-3 col-md-6 col-12">

                    <!-- Single Widget -->
                    <div class="single-footer footer-newsletter">
                        <?php if(!empty(toption('footer','newsletter-code'))): ?>
                            <?php echo toption('footer','newsletter-code'); ?>

                        <?php else: ?>
                        <h3><?php echo e(__t('stay-updated')); ?></h3>
                        <p><?php echo e(__t('subscribe-text')); ?></p>
                        <form action="#" method="get" target="_blank" class="newsletter-form">
                            <input name="EMAIL" placeholder="<?php echo e(__t('enter-email')); ?>" class="common-input"
                                   onfocus="this.placeholder = ''"
                                   onblur="this.placeholder = '<?php echo e(addslashes(__t('enter-email'))); ?>'" required="" type="email">
                            <div class="button">
                                <button class="btn"><?php echo e(__t('subscribe-now')); ?></button>
                            </div>
                        </form>
                        <?php endif; ?>

                    </div>
                    <!-- End Single Widget -->

                </div>
            </div>
        </div>
    </div>
    <!--/ End Footer Middle -->
    <!-- Start Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="inner">
                <div class="row">
                    <div class="col-12">
                        <div class="left">
                            <p><?php echo clean( fullstop(toption('footer','credits')) ); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Middle -->
</footer>
<!--/ End Footer Area -->

<!-- ========================= scroll-top ========================= -->
<a href="#" class="scroll-top btn-hover">
    <i class="lni lni-chevron-up"></i>
</a>

<!-- ========================= JS here ========================= -->
<script src="<?php echo e(tasset('assets/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(tasset('assets/js/count-up.min.js')); ?>"></script>
<script src="<?php echo e(tasset('assets/js/wow.min.js')); ?>"></script>
<script src="<?php echo e(tasset('assets/js/tiny-slider.js')); ?>"></script>
<script src="<?php echo e(tasset('assets/js/glightbox.min.js')); ?>"></script>
<script src="<?php echo e(tasset('assets/js/main.js')); ?>"></script>
<?php echo $__env->yieldContent('footer'); ?>
<?php echo setting('general_foot_scripts'); ?>

</body>

</html>
<?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\public\templates/edugrids/views/layouts/layout.blade.php ENDPATH**/ ?>