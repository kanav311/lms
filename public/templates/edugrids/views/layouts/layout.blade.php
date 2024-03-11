<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>@yield('page-title')</title>
    <meta name="description" content="@yield('meta-description')">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @if(!empty(setting('image_icon')))
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset(setting('image_icon')) }}">
    @endif

    <!-- Web Font -->
    <link  href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ tasset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ tasset('assets/css/LineIcons.2.0.css') }}" />
    <link rel="stylesheet" href="{{ tasset('assets/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ tasset('assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ tasset('assets/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ tasset('assets/css/main') }}" />

    <link rel="stylesheet" href="{{ tasset('assets/css/fontawesome-all.min.css') }}">

    @yield('header')
    {!!  setting('general_header_scripts')  !!}
    @if(optionActive('top-bar'))
        <style>
            @if(!empty(toption('top-bar','bg_color')))
                .header .toolbar-area{
                background-color: #{{ toption('top-bar','bg_color') }};
            }
            @endif

                     @if(!empty(toption('top-bar','font_color')))
              .header .toolbar-area .toolbar-social ul li .title,.header .toolbar-area .toolbar-social ul li a,.header .toolbar-login a {
                color: #{{ toption('top-bar','font_color') }};
            }
            @endif



        </style>
    @endif


    @if(optionActive('navigation'))
        <style>
            @if(!empty(toption('navigation','bg_color')))
                header.header,.navbar-area.sticky,.navbar-collapse,.navbar-nav .nav-item .sub-menu{
                background-color: #{{ toption('navigation','bg_color') }};
            }
            @endif

            @if(!empty(toption('navigation','font_color')))
                .navbar-nav .nav-item a,.sticky .navbar .navbar-nav .nav-item a,.header .search-form .btn-outline-success,.sticky .navbar .navbar-nav .nav-item a,sticky .navbar .navbar-nav .nav-item a:hover,.navbar-nav .nav-item .sub-menu .nav-item a{
                color: #{{ toption('navigation','font_color') }};
                }
            .mobile-menu-btn .toggler-icon,.sticky .navbar .mobile-menu-btn .toggler-icon {
                background-color: #{{ toption('navigation','font_color') }};
            }
            @endif



        </style>
    @endif
    <style>
        @if(optionActive('footer'))

                    @if(!empty(toption('footer','image')))

                        .footer{
                            background: url({{ toption('footer','image') }});
                        }

                    @endif

                    @if(!empty(toption('footer','bg_color')))

                        .footer{
                        background-color: #{{ toption('footer','bg_color') }};
                        }

                    @endif

                    @if(!empty(toption('footer','font_color')))
                        .footer,.footer a,.footer .recent-blog ul li a,.footer .f-link ul li a,.footer .single-footer h3{
                            color: #{{ toption('footer','font_color') }};
                        }
                    @endif

                       @if(!empty(toption('footer','credits_bg_color')))

                            .footer .footer-bottom{
                                background-color: #{{ toption('footer','credits_bg_color') }};
                            }

                        @endif

                      @if(!empty(toption('footer','credits_font_color')))
                        .footer .footer-bottom .inner p{
                        color: #{{ toption('footer','credits_font_color') }};
                        }
                    @endif

        @endif



        @if(optionActive('page-title'))
                @if(!empty(toption('page-title','bg_color')))
                    .breadcrumbs{
                    background-color: #{{ toption('page-title','bg_color') }} ;
                }
                @endif

                @if(!empty(toption('page-title','font_color')))
                            .breadcrumbs .breadcrumbs-content .page-title,.breadcrumbs .breadcrumb-nav li, .breadcrumbs .breadcrumb-nav li a {
                    color: #{{ toption('page-title','font_color') }};
                }
                @endif

        @endif
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
    @if(optionActive('top-bar'))
    <!-- Toolbar Start -->
    <div class="toolbar-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6 col-12">
                    <div class="toolbar-social">
                        <ul>
                            @if(getCart()->getTotalItems()==0)
                                        <li><span class="title">{{ __t('follow-us-on') }} : </span></li>

                                        @if(!empty(toption('top-bar','social_facebook')))
                                        <li><a href="{{ toption('top-bar','social_facebook') }}"><i class="lni lni-facebook-original"></i></a></li>
                                        @endif
                                        @if(!empty(toption('top-bar','social_twitter')))
                                        <li><a href="{{ toption('top-bar','social_twitter') }}"><i class="lni lni-twitter-original"></i></a></li>
                                        @endif
                                        @if(!empty(toption('top-bar','social_instagram')))
                                        <li><a href="{{ toption('top-bar','social_instagram') }}"><i class="lni lni-instagram"></i></a></li>
                                        @endif
                                        @if(!empty(toption('top-bar','social_linkedin')))
                                        <li><a href="{{ toption('top-bar','social_linkedin') }}"><i class="lni lni-linkedin-original"></i></a></li>
                                        @endif
                                        @if(!empty(toption('top-bar','social_youtube')))
                                        <li><a href="{{ toption('top-bar','social_youtube') }}"><i class="lni lni-youtube"></i></a></li>
                                        @endif
                            @else

                                <li><a href="{{ route('cart') }}"><i class="lni lni-cart"></i> {{ __lang('your-cart') }}@if(getCart()->getTotalItems()>0) ({{ getCart()->getTotalItems() }}) @endif</a></li>
                            @endif

                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="toolbar-login">
                        <div class="button">
                            @guest
                                <a href="{{ route('register') }}">{{ __lang('register') }}</a>
                                <a href="{{ route('login') }}" class="btn">@lang('default.login')</a>
                            @else
                                <a  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" href="{{ route('logout') }}" >{{ __lang('logout') }}</a>
                                <a href="{{ route('home') }}" class="btn">@lang('default.my-account')</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST"  class="int_hide  hidden">
            @csrf
        </form>
    <!-- Toolbar End -->
    @endif

    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="nav-inner">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            @if(!empty(setting('image_logo')))
                                <img src="{{ asset(setting('image_logo')) }}" >
                            @else
                                {{ setting('general_site_name') }}
                            @endif

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

                                @foreach(headerMenu() as $key=>$menu)

                                    <li class="nav-item">
                                        <a @if($menu['new_window']) target="_blank" @endif @if($menu['children']) class="page-scroll @if($menu['url']==request()->url() || urlInMenu(request()->url(),$menu)) active @endif dd-menu collapsed" href="javascript:void(0)"    data-bs-toggle="collapse" data-bs-target="#submenu-1-{{ $key }}"
                                           aria-controls="navbarSupportedContent" aria-expanded="false"
                                           aria-label="Toggle navigation" @else @if($menu['url']==request()->url()) class="active" @endif  href="{{ $menu['url'] }}" @endif >{{ $menu['label'] }}</a>
                                        @if($menu['children'])
                                            <ul  class="sub-menu collapse" id="submenu-1-{{ $key }}">
                                                @foreach($menu['children'] as $childMenu)
                                                    <li class="nav-item" ><a @if($childMenu['new_window']) target="_blank" @endif  href="{{ $childMenu['url'] }}" >{{ $childMenu['label'] }}</a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach

                            </ul>
                            @if(toption('navigation','search_form')==1)
                            <form action="{{ route('courses') }}"  class="d-flex search-form">
                                <input class="form-control me-2" name="filter" type="search" placeholder="{{ __lang('search-courses') }}"
                                       aria-label="{{ __lang('search-courses') }}">
                                <button class="btn btn-outline-success" type="submit"><i
                                        class="lni lni-search-alt"></i></button>
                            </form>
                            @endif
                        </div> <!-- navbar collapse -->
                    </nav> <!-- navbar -->
                </div>
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</header>
<!-- End Header Area -->

@hasSection('inline-title')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs overlay"
         @if(!empty(toption('page-title','image')))
             style="background-image: url({{ asset(toption('page-title','image')) }});"
         @elseif(empty(toption('page-title','bg_color')))
            style="background-image: url({{ tasset('assets/images/demo/breadcrumb-bg.jpg') }});"
        @endif
    >
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">@yield('inline-title')</h1>
                    </div>
                    @hasSection('crumb')
                    <ul class="breadcrumb-nav">
                        <li><a href="@route('homepage')">@lang('default.home')</a></li>
                        @yield('crumb')
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
@endif

@include('partials.flash_message')
@yield('content')


<!-- Start Footer Area -->
<footer class="footer">
    <!-- Start Middle Top -->
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="f-about single-footer">
                        @if(!empty(setting('image_logo')))
                        <div class="logo">
                            <a href="{{ url('/') }}"><img src="{{ asset(setting('image_logo')) }}" ></a>
                        </div>
                        @endif
                        <p>{{ toption('footer','text') }}</p>
                        <div class="footer-social">
                            <ul>
                                @if(!empty(toption('footer','social_facebook')))
                                <li><a href="{{ toption('footer','social_facebook') }}"><i class="lni lni-facebook-original"></i></a></li>
                                @endif
                                @if(!empty(toption('footer','social_twitter')))
                                <li><a href="{{ toption('footer','social_twitter') }}"><i class="lni lni-twitter-original"></i></a></li>
                                @endif
                                @if(!empty(toption('footer','social_instagram')))
                                    <li><a href="{{ toption('footer','social_instagram') }}"><i class="lni lni-instagram"></i></a></li>
                                @endif
                                @if(!empty(toption('footer','social_linkedin')))
                                <li><a href="{{ toption('footer','social_linkedin') }}"><i class="lni lni-linkedin-original"></i></a></li>
                                @endif
                                @if(!empty(toption('footer','social_youtube')))
                                <li><a href="{{ toption('footer','social_youtube') }}"><i class="lni lni-youtube"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Widget -->
                </div>
                @if(toption('footer','blog')==1)
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer sm-custom-border recent-blog">
                        <h3>{{ __t('latest-news') }}</h3>

                        <ul>
                            @foreach(getLatestBlogPosts(2) as $post)
                            <li>
                                <a @if(empty($post->cover_photo)) style="padding-left: 0px" @endif href="{{ route('blog.post',['blogPost'=>$post->id,'slug'=>safeUrl($post->title)]) }}">
                                    @if(!empty($post->cover_photo))
                                        <img src="{{ resizeImage($post->cover_photo,100,100) }}" alt="">
                                    @endif
                                    {{ $post->title }}
                                </a>
                                <span  @if(empty($post->cover_photo)) style="padding-left: 0px" @endif  class="date"><i class="lni lni-calendar"></i>{{  \Carbon\Carbon::parse($post->publish_date)->format('M d, Y') }}</span>
                            </li>
                            @endforeach


                        </ul>

                    </div>
                    <!-- End Single Widget -->
                </div>
                @endif
                @foreach(footerMenu() as $menu)
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer sm-custom-border f-link">
                        <h3>{{ $menu['label'] }}</h3>
                        <ul>
                            @if($menu['children'] && is_array($menu['children']))
                            @foreach($menu['children'] as $childMenu)
                                <li><a  @if($childMenu['new_window']) target="_blank" @endif  href="{{ $childMenu['url'] }}">{{ $childMenu['label'] }}</a></li>
                            @endforeach
                                @endif
                        </ul>
                    </div>
                    <!-- End Single Widget -->
                </div>
                @endforeach
                <div class="col-lg-3 col-md-6 col-12">

                    <!-- Single Widget -->
                    <div class="single-footer footer-newsletter">
                        @if(!empty(toption('footer','newsletter-code')))
                            {!! toption('footer','newsletter-code') !!}
                        @else
                        <h3>{{ __t('stay-updated') }}</h3>
                        <p>{{ __t('subscribe-text') }}</p>
                        <form action="#" method="get" target="_blank" class="newsletter-form">
                            <input name="EMAIL" placeholder="{{ __t('enter-email') }}" class="common-input"
                                   onfocus="this.placeholder = ''"
                                   onblur="this.placeholder = '{{ addslashes(__t('enter-email')) }}'" required="" type="email">
                            <div class="button">
                                <button class="btn">{{ __t('subscribe-now') }}</button>
                            </div>
                        </form>
                        @endif

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
                            <p>{!! clean( fullstop(toption('footer','credits')) ) !!}</p>
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
<script src="{{ tasset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ tasset('assets/js/count-up.min.js') }}"></script>
<script src="{{ tasset('assets/js/wow.min.js') }}"></script>
<script src="{{ tasset('assets/js/tiny-slider.js') }}"></script>
<script src="{{ tasset('assets/js/glightbox.min.js') }}"></script>
<script src="{{ tasset('assets/js/main.js') }}"></script>
@yield('footer')
{!!  setting('general_foot_scripts')  !!}
</body>

</html>
