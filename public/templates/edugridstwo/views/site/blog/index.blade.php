@extends(TLAYOUT)

@section('page-title',$title)
@section('inline-title',$title)

@section('crumb')
    @if(request()->has('category'))
        <li><a href="{{ route('blog') }}">@lang('default.blog')</a></li>
        <li>@lang('default.category')</li>
    @endif
@endsection

@section('content')


    <!-- Start Blog Singel Area -->
    <section class="section latest-news-area blog-grid-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="row">
                        @php
                            $count=4;
                        @endphp
                        @foreach($posts as $post)
                            @php

                                    if($count==2){
                                        $count=4;
                                    }
                                    else{
                                        $count = 2;
                                    }
                            @endphp
                        <div class="col-lg-6 col-12">
                            <!-- Single News -->
                            <div class="single-news custom-shadow-hover wow fadeInUp" data-wow-delay=".{{ $count }}s">
                                @if(!empty($post->cover_photo))
                                <div class="image">
                                    <a href="{{ route('blog.post',['blogPost'=>$post->id,'slug'=>safeUrl($post->title)]) }}"><img class="thumb"
                                                                            src="{{ resizeImage($post->cover_photo,1050,700) }}" alt="#"></a>
                                </div>
                                @endif
                                <div class="content-body">
                                    <div class="meta-data">
                                        <ul>
                                            @if($post->blogCategories()->count()>0)
                                            <li>
                                                <i class="lni lni-tag"></i>
                                                <a href="{{ route('blog') }}?category={{ $post->blogCategories()->first()->id }}">{{ $post->blogCategories()->first()->name }}</a>
                                            </li>
                                            @endif
                                            <li>
                                                <i class="lni lni-calendar"></i>
                                                <a href="javascript:void(0)">{{ \Illuminate\Support\Carbon::parse($post->publish_date)->format('M d,Y') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <h4 class="title"><a href="{{ route('blog.post',['blogPost'=>$post->id,'slug'=>safeUrl($post->title)]) }}">{{ $post->title }}</a></h4>
                                    <p>{{ limitLength(strip_tags($post->content),300) }}</p>
                                    <div class="button">
                                        <a href="{{ route('blog.post',['blogPost'=>$post->id,'slug'=>safeUrl($post->title)]) }}" class="btn">{{ __lang('read-more') }}</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single News -->
                        </div>
                        @endforeach
                    </div>
                    <!-- Pagination -->
                    <div class="pagination center">

                            <nav class="blog-pagination justify-content-center d-flex">
                                {!! clean( $posts->appends(['q' => Request::get('q'),'category' => Request::get('category')])->links('edugrids.views.site.blog.paginator') ) !!}

                            </nav>

                    </div>
                    <!--/ End Pagination -->
                </div>
                <aside class="col-lg-4 col-md-5 col-12">
                    <div class="sidebar">
                        <!-- Single Widget -->
                        <div class="widget search-widget">
                            <h5 class="widget-title">@lang('default.search')</h5>
                            <form method="get" action="{{ route('blog') }}">
                                <input type="text" name="q" placeholder="@lang('default.search')...">
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                            </form>
                        </div>
                        <!--/ End Single Widget -->

                        <!-- Single Widget -->
                        <div class="widget categories-widget">
                            <h5 class="widget-title">@lang('default.categories')</h5>
                            <ul class="custom">
                                @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('blog') }}?category={{ $category->id }}">{{ $category->name }} <span>{{ $category->blogPosts()->count() }}</span></a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <!--/ End Single Widget -->
                        <!-- Single Widget -->
                        <div class="widget popular-feeds">
                            <h5 class="widget-title">{{ __t('recent-posts') }}</h5>
                            <div class="popular-feed-loop">
                                @foreach(\App\BlogPost::whereDate('publish_date','<=',\Illuminate\Support\Carbon::now()->toDateTimeString())->where('enabled',1)->orderBy('publish_date','desc')->limit(5)->get() as $post)

                                <div class="single-popular-feed"  @if(empty($post->cover_photo)) style="padding-left: 0px" @endif >
                                    @if(!empty($post->cover_photo))
                                    <div class="feed-img">
                                        <a href="{{ route('blog.post',['blogPost'=>$post->id,'slug'=>safeUrl($post->title)]) }}"><img src="{{ resizeImage($post->cover_photo,300,300) }}"
                                                                        alt="#"></a>
                                    </div>
                                    @endif
                                    <div class="feed-desc">
                                        <h6 class="post-title"><a  href="{{ route('blog.post',['blogPost'=>$post->id,'slug'=>safeUrl($post->title)]) }}">{{ $post->title }}</a>
                                        </h6>
                                        <span class="time"><i class="lni lni-calendar"></i>{{  \Carbon\Carbon::parse($post->publish_date)->format('d M, Y') }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!--/ End Single Widget -->


                    </div>
                </aside>
            </div>
        </div>
    </section>
    <!-- End Blog Singel Area -->

    @if(false)
    <!--================Blog Area =================-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        @foreach($posts as $post)
                        <article class="blog_item">
                            @if(!empty($post->cover_photo))
                            <div class="blog_item_img">
                                @if(!empty($post->cover_photo))
                                <img class="card-img rounded-0" src="{{ asset($post->cover_photo) }}" alt="">
                                @endif
                                <a href="#" class="blog_item_date">
                                    <h3>{{ \Illuminate\Support\Carbon::parse($post->publish_date)->format('d') }}</h3>
                                    <p>{{ \Illuminate\Support\Carbon::parse($post->publish_date)->format('M') }}</p>
                                </a>
                            </div>
                            @endif

                            <div class="blog_details">
                                <a class="d-inline-block" href="{{ route('blog.post',['blogPost'=>$post->id,'slug'=>safeUrl($post->title)]) }}">
                                    <h2>{{ $post->title }}</h2>
                                </a>
                                <p>{{ limitLength(strip_tags($post->content),300) }}</p>

                                @if($post->admin)
                                <ul class="blog-info-link">
                                    <li><a href="#"><i class="fa fa-user"></i> {{ $post->admin->user->name }}</a></li>

                                </ul>
                                    @endif
                            </div>
                        </article>
                        @endforeach

                        <nav class="blog-pagination justify-content-center d-flex">
                            {!! clean( $posts->appends(['q' => Request::get('q'),'category' => Request::get('category')])->render() ) !!}

                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form method="get" action="{{ route('blog') }}">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input  name="q"  type="text" class="form-control" placeholder='@lang('default.search')'
                                               onfocus="this.placeholder = ''"
                                               onblur="this.placeholder = '@lang('default.search')'">
                                        <div class="input-group-append">
                                            <button class="btns" type="submit"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                        type="submit">@lang('default.search')</button>
                            </form>
                        </aside>

                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">@lang('default.category')</h4>
                            <ul class="list cat-list">
                                @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('blog') }}?category={{ $category->id }}" class="d-flex">
                                        <p>{{ $category->name }}</p>
                                        <p>&nbsp;({{ $category->blogPosts()->count() }})</p>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </aside>

                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">{{ __t('recent-posts') }}</h3>
                            @foreach(\App\BlogPost::whereDate('publish_date','<=',\Illuminate\Support\Carbon::now()->toDateTimeString())->where('enabled',1)->orderBy('publish_date','desc')->limit(5)->get() as $post)
                            <div class="media post_item">
                                @if(!empty($post->cover_photo))
                                    <img class="recent-blog-img" src="{{ asset($post->cover_photo) }}" alt="">
                                    @endif
                                <div class="media-body">
                                    <a href="{{ route('blog.post',['blogPost'=>$post->id,'slug'=>safeUrl($post->title)]) }}">
                                        <h3>{{ $post->title }}</h3>
                                    </a>
                                    <p>{{  \Carbon\Carbon::parse($post->publish_date)->format('F d, Y') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </aside>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
    @endif

@endsection
