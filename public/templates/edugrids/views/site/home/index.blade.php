@extends(TLAYOUT)
@section('page-title',setting('general_homepage_title'))
@section('meta-description',setting('general_homepage_meta_desc'))

@section('content')

    <main>


    @if(optionActive('slideshow'))

            <!-- Start Hero Area -->
            <section class="hero-area">
                <div class="hero-slider">
                @for($i=1;$i<=10;$i++)
                    @if(!empty(toption('slideshow','file'.$i)))
                    @section('header')
                        @parent

                        <style>

                            @if(!empty(toption('slideshow','heading_font_color'.$i)))

                                            .slhc{{ $i }}{
                                color: #{{ toption('slideshow','heading_font_color'.$i) }} !important;
                            }

                            @endif

                                        @if(!empty(toption('slideshow','text_font_color'.$i)))
                                        .sltx{{ $i }}{
                                color: #{{ toption('slideshow','text_font_color'.$i) }} !important;
                            }
                            @endif

                        </style>



                    @endsection

                    <!-- Single Slider -->
                    <div class="hero-inner overlay" style="background-image: url('{{ resizeImage(toption('slideshow','file'.$i),1600,680) }}');">
                        <div class="container">
                            <div class="row ">
                                <div class="col-lg-8 offset-lg-2 col-md-12 co-12">
                                    <div class="home-slider">
                                        <div class="hero-text">
                                            <h5 class="wow fadeInUp" data-wow-delay=".3s">{{ toption('slideshow','sub_heading'.$i) }}</h5>
                                            <h1 class="wow fadeInUp" data-wow-delay=".5s"   @if(!empty(toption('slideshow','heading_font_color'.$i))) class="slhc{{ $i }}" @endif     >{{ toption('slideshow','slide_heading'.$i) }}</h1>
                                            <p class="wow fadeInUp" data-wow-delay=".7s"    @if(!empty(toption('slideshow','text_font_color'.$i))) class="sltx{{ $i }}" @endif   >{!!  nl2br(toption('slideshow','slide_text'.$i))  !!}</p>
                                            <div class="button wow fadeInUp" data-wow-delay=".9s">
                                                @if(!empty(toption('slideshow','button_1_text'.$i)))
                                                    <a href="{{ url(toption('slideshow','url_1'.$i)) }}" class="btn">{{ toption('slideshow','button_1_text'.$i) }}</a>
                                                @endif
                                                @if(!empty(toption('slideshow','button_2_text'.$i)))
                                                    <a href="{{ url(toption('slideshow','url_2'.$i)) }}" class="btn alt-btn">{{ toption('slideshow','button_2_text'.$i) }}</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Single Slider -->

                    @endif
                @endfor


                </div>
            </section>
                @section('footer')
                    @parent
                    <script>
                        tns({
                            container: '.hero-slider',
                            items: 1,
                            slideBy: 'page',
                            autoplay: false,
                            mouseDrag: true,
                            gutter: 0,
                            nav: true,
                            controls: false,
                            controlsText: ['<i class="lni lni-arrow-left"></i>', '<i class="lni lni-arrow-right"></i>'],
                        });
                    </script>
                @endsection
            <!--/ End Hero Area -->

    @endif



        @if(optionActive('homepage-services'))

            <!-- Start Features Area -->
            <section class="features">
                <div class="container-fluid">
                    <div class="single-head">
                        <div class="row">
                            @for($i=1;$i<=3;$i++)
                                @if(!empty(toption('homepage-services','heading'.$i)))
                            <div class="col-lg-4 col-md-4 col-12 padding-zero">
                                <!-- Start Single Feature -->
                                <div class="single-feature">
                                    <h3><a href="{{ url(toption('homepage-services','url'.$i)) }}">{{ toption('homepage-services','heading'.$i) }}</a></h3>
                                    <p>{{ toption('homepage-services','text'.$i) }}</p>
                                    <div class="button">
                                        <a href="{{ url(toption('homepage-services','url'.$i)) }}" class="btn">{{ toption('homepage-services','button_text'.$i) }} <i class="lni lni-arrow-right"></i></a>
                                    </div>
                                </div>
                                <!-- End Single Feature -->
                            </div>
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
            </section>
            <!-- /End Features Area -->
        @endif

        @if(optionActive('homepage-about'))
    <!-- Start About Us Area -->
    <section class="about-us section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="about-left">
                        <div class="about-title align-left">
                            <span class="wow fadeInDown" data-wow-delay=".2s">{{ toption('homepage-about','sub_heading') }}</span>
                            <h2 class="wow fadeInUp" data-wow-delay=".4s">{{ toption('homepage-about','heading') }}</h2>
                            <p class="wow fadeInUp" data-wow-delay=".6s">{!! clean(toption('homepage-about','text')) !!}</p>
                            <div class="button wow fadeInUp" data-wow-delay="1s">
                                <a href="{{ url(toption('homepage-about','button_url')) }}" class="btn">{{ toption('homepage-about','button_text') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                @if(!empty(toption('homepage-about','image')))
                <div class="col-lg-6 col-12">
                    <div class="about-right wow fadeInRight" data-wow-delay=".4s">
                        <img src="{{ resizeImage(toption('homepage-about','image'),1200,960) }}" alt="#">
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    <!-- /End About Us Area -->
        @endif

    @if(optionActive('featured-courses'))
    <!-- Start Courses Area -->
    <section class="courses section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <div class="section-icon wow zoomIn" data-wow-delay=".4s">
                            <i class="lni lni-graduation"></i>
                        </div>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">{{ toption('featured-courses','heading') }}</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">{{ toption('featured-courses','sub_heading') }}</p>
                    </div>
                </div>
            </div>
            <div class="single-head">
                <div class="row">
                    @php
                        $courses = toption('featured-courses','courses');
                    @endphp
                    @if(is_array($courses))
                        @foreach(toption('featured-courses','courses') as $course)
                            @if(!empty($course) && \App\Course::find($course))
                                @php
                                    $course = \App\Course::find($course);
                                @endphp
                    <div class="col-lg-4 col-md-6 col-12">
                        <!-- Start Single Course -->
                        <div class="single-course wow fadeInUp" data-wow-delay=".2s">
                            <div class="course-image">
                                @if(!empty($course->picture))
                                <a href="{{ route('course',['course'=>$course->id,'slug'=>safeUrl($course->name)]) }}">
                                 @if(!empty($course->picture))
                                 <img src="{{ resizeImage($course->picture,550,340) }}" alt="{{ $course->name }}">
                                 @else
                                        <img src="{{ asset('img/course.png') }}" alt="{{ $course->name }}">
                                 @endif
                                </a>
                                @endif
                                <p class="price">{{ sitePrice($course->fee) }}</p>
                            </div>
                            <div class="content">
                                <h3><a href="{{ route('course',['course'=>$course->id,'slug'=>safeUrl($course->name)]) }}">{{ $course->name }}</a></h3>
                                <p>{{ limitLength(strip_tags($course->short_description),100) }}</p>
                            </div>
                            <div class="bottom-content">
                                <ul class="review">
                                    <li>{{ sitePrice($course->fee) }}</li>
                                </ul>
                                @if($course->courseCategories()->count()>0)
                                <span class="tag">
                                    <i class="lni lni-tag"></i>
                                    <a href="{{ route('courses') }}?group={{ $course->courseCategories()->first()->id }}">{{ $course->courseCategories()->first()->name }}</a>
                                </span>
                                @endif
                            </div>
                        </div>
                        <!-- End Single Course -->
                    </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- End Courses Area -->
    @endif

    @if(optionActive('highlights'))
        @if(!empty(toption('highlights','image')))
            @section('header')
                @parent
            <style>
                .our-achievement{
                    background-image: url("{{ resizeImage(toption('highlights','image'),1920,1360) }}");
                }
            </style>
            @endsection
        @endif
    <!-- Start Achivement Area -->
    <section class="our-achievement section overlay">
        <div class="container">
            <div class="row">
                @for($i=0;$i<=4;$i++)
                    @if(!empty(toption('highlights','heading'.$i)))
                <div class="col-lg-3 col-md-3 col-12">
                    <div class="single-achievement wow fadeInUp" data-wow-delay=".2s">
                        <h3 class="counter_">{{ toption('highlights','heading'.$i) }}</h3>
                        <h4>{{ toption('highlights','text'.$i) }}</h4>
                    </div>
                </div>
                    @endif
                @endfor



            </div>
        </div>
    </section>
    <!-- End Achivement Area -->
    @endif


    @if(optionActive('instructors'))
    <!-- Start Teachers -->
    <section id="teachers" class="teachers section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title align-center gray-bg">
                        <div class="section-icon wow zoomIn" data-wow-delay=".4s">
                            <i class="lni lni-users"></i>
                        </div>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">{{ toption('instructors','heading') }}</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">{{ toption('instructors','sub_heading') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
            @php
                $instructors = toption('instructors','instructors');
            @endphp
            @if(is_array($instructors))

                @foreach(toption('instructors','instructors') as $admin)
                    @php
                        $admin = \App\Admin::find($admin);
                    @endphp
                    @if($admin)
                        <!-- Single Team -->
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="single-team wow fadeInUp" data-wow-delay=".2s">
                                <div class="row">
                                    <div class="col-lg-5 col-12">
                                        <!-- Image -->
                                        <div class="image">
                                            @if(empty($admin->user->picture))
                                                <img src="{{ asset('img/user.png') }}" alt="">
                                            @else
                                                <img src="{{ resizeImage($admin->user->picture,800,1020) }}" alt="">
                                            @endif
                                        </div>
                                        <!-- End Image -->
                                    </div>
                                    <div class="col-lg-7 col-12">
                                        <div class="info-head">
                                            <!-- Info Box -->
                                            <div class="info-box">
                                                <span class="designation">{{ $admin->user->name }}</span>
                                                <h4 class="name"><a href="{{ route('instructor',['admin'=>$admin->id]) }}">{{ $admin->user->last_name }}</a></h4>
                                                <p>{{ limitLength($admin->about,150) }}</p>
                                            </div>
                                            <!-- End Info Box -->
                                            <!-- Social -->
                                            <ul class="social">

                                                @if(!empty($admin->social_facebook))
                                                <li><a href="{{  fullUrl($admin->social_facebook) }}"><i class="lni lni-facebook-filled"></i></a></li>
                                                @endif
                                                @if(!empty($admin->social_twitter))
                                                <li><a href="{{ fullUrl($admin->social_twitter) }}"><i class="lni lni-twitter-original"></i></a></li>
                                                @endif
                                                @if(!empty($admin->social_linkedin))
                                                <li><a href="{{ fullUrl($admin->social_linkedin) }}"><i class="lni lni-linkedin-original"></i></a></li>
                                                @endif
                                                @if(!empty($admin->social_instagram))
                                                <li><a href="{{ fullUrl($admin->social_instagram) }}"><i class="lni lni-instagram-original"></i></a></li>
                                                @endif
                                                @if(!empty($admin->social_website))
                                                <li><a href="{{ fullUrl($admin->social_website) }}"><i class="lni lni-world"></i></a></li>
                                                @endif

                                            </ul>
                                            <!-- End Social -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Team -->
                    @endif
                @endforeach

            @endif

            </div>
        </div>
    </section>
    <!--/ End Teachers Area -->
    @endif


        @if(optionActive('testimonials'))
    <!-- Start Testimonials Area -->
    <section class="testimonials section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title align-center gray-bg">
                        <div class="section-icon wow zoomIn" data-wow-delay=".4s">
                            <i class="lni lni-quotation"></i>
                        </div>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">{{ toption('testimonials','heading') }}</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">{{ toption('testimonials','sub_heading') }}</p>
                    </div>
                </div>
            </div>
            <div class="row testimonial-slider">

                @for($i=1;$i <= 6; $i++)
                    @if(!empty(toption('testimonials','name'.$i)))
                    <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Testimonial -->
                    <div class="single-testimonial">
                        <div class="text">
                            <p>"{{ toption('testimonials','text'.$i) }}"</p>
                        </div>
                        <div class="author">


                            @if(!empty(toption('testimonials','image'.$i)))
                                <img   src="{{ resizeImage(toption('testimonials','image'.$i),300,300) }}" >
                            @else
                                <img   src="{{ asset('img/man.jpg') }}">
                            @endif

                            <h4 class="name">
                                {{ toption('testimonials','name'.$i) }}
                                <span class="deg">{{ toption('testimonials','role'.$i) }}</span>
                            </h4>
                        </div>
                    </div>
                    <!-- End Single Testimonial -->
                </div>
                    @endif
                @endfor

            </div>
        </div>
    </section>
        @section('footer')
            @parent
            <script>
                //========= testimonial
                tns({
                    container: '.testimonial-slider',
                    items: 3,
                    slideBy: 'page',
                    autoplay: false,
                    mouseDrag: true,
                    gutter: 0,
                    nav: true,
                    controls: false,
                    controlsText: ['<i class="lni lni-arrow-left"></i>', '<i class="lni lni-arrow-right"></i>'],
                    responsive: {
                        0: {
                            items: 1,
                        },
                        540: {
                            items: 1,
                        },
                        768: {
                            items: 2,
                        },
                        992: {
                            items: 2,
                        },
                        1170: {
                            items: 3,
                        }
                    }
                });
            </script>
    @endsection
    <!-- End Testimonial Area -->
    @endif


        @if(optionActive('blog'))
    <!-- Start Latest News Area -->
    <div class="latest-news-area section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <div class="section-icon wow zoomIn" data-wow-delay=".4s">
                            <i class="lni lni-quotation"></i>
                        </div>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">{{ toption('blog','heading') }}</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">{{ toption('blog','sub_heading') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach(\App\BlogPost::whereDate('publish_date','<=',\Illuminate\Support\Carbon::now()->toDateTimeString())->where('enabled',1)->orderBy('publish_date','desc')->limit(intval(toption('blog','limit')))->get() as $post)

                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single News -->
                    <div class="single-news custom-shadow-hover wow fadeInUp" data-wow-delay=".2s">
                        <div class="image">
                            @if(!empty($post->cover_photo))
                            <a href="{{ route('blog.post',['blogPost'=>$post->id,'slug'=>safeUrl($post->title)]) }}"><img class="thumb"  src="{{ resizeImage($post->cover_photo,1050,700) }}" alt="#"></a>
                            @endif
                        </div>
                        <div class="content-body">
                            <div class="meta-data">
                                <ul>
                                    @php
                                        $category = $post->blogCategories()->first();
                                    @endphp

                                    @if($category)
                                    <li>
                                        <i class="lni lni-tag"></i>
                                        <a href="{{ route('blog') }}?category={{ $category->id }}">{{ $category->name }}</a>
                                    </li>
                                    @endif

                                    <li>
                                        <i class="lni lni-calendar"></i>
                                        <a href="javascript:void(0)">{{  \Carbon\Carbon::parse($post->publish_date)->format('M d, Y') }}</a>
                                    </li>

                                </ul>
                            </div>
                            <h4 class="title"><a href="{{ route('blog.post',['blogPost'=>$post->id,'slug'=>safeUrl($post->title)]) }}">{{ $post->title }}</a></h4>
                            <p>{{ limitLength(strip_tags($post->content),150) }}</p>
                            <div class="button">
                                <a href="{{ route('blog.post',['blogPost'=>$post->id,'slug'=>safeUrl($post->title)]) }}" class="btn">{{ __lang('read-more') }}</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Single News -->
                </div>

                @endforeach
            </div>
        </div>
    </div>
    <!-- End Latest News Area -->
        @endif


        @if(optionActive('icons'))
    <!-- Start Clients Area -->
    <div class="client-logo-section">
        <div class="container">
            <div class="client-logo-wrapper">
                <div class="client-logo-carousel d-flex align-items-center justify-content-between">
                    @for($i=1;$i <= 12; $i++)
                     @if(!empty(toption('icons','image'.$i)))
                    <div class="client-logo">
                        <img src="{{ resizeImage(toption('icons','image'.$i),230,95) }}" alt="#">
                    </div>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
    </div>
        @section('footer')
            @parent
            <script>
                //====== Clients Logo Slider
                tns({
                    container: '.client-logo-carousel',
                    slideBy: 'page',
                    autoplay: true,
                    autoplayButtonOutput: false,
                    mouseDrag: true,
                    gutter: 15,
                    nav: false,
                    controls: false,
                    responsive: {
                        0: {
                            items: 1,
                        },
                        540: {
                            items: 3,
                        },
                        768: {
                            items: 4,
                        },
                        992: {
                            items: 4,
                        },
                        1170: {
                            items: 6,
                        }
                    }
                });
            </script>
        @endsection
    <!-- End Clients Area -->
        @endif


    </main>
@endsection




