@extends(TLAYOUT)

@section('page-title',$pageTitle)
@section('inline-title',$pageTitle)
@section('crumb')
    @if($group)
        <li><a href="{{ route('courses') }}">@lang('default.categories')</a></li>
        <li>@lang('default.category')</li>
    @endif
@endsection
@section('content')

    <!-- Start Events Area-->
    <section class="courses section grid-page">
        <div class="container">
        <div class="row">
            <aside class="col-lg-4 col-md-12 col-12">
                <div class="sidebar">

                @if($subCategories || $parent)
                    <!-- Single Widget -->
                    <div class="widget categories-widget">
                        <h5 class="widget-title">{{ __lang('sub-categories') }}</h5>
                        <ul class="custom">

                            @if($parent)
                            <li>
                                <a href="{{ route('courses') }}?group={{ $parent->id }}"><strong>{{ __lang('parent') }}: {{ $parent->name }}</strong></a>
                            </li>
                            @endif

                                @if($subCategories)
                                    @foreach($subCategories as $category)
                            <li>
                                <a href="{{ route('courses') }}?group={{ $category->id }}">{{ $category->name }} <span>{{ $category->courses()->count() }}</span></a>
                            </li>

                                    @endforeach
                                @endif

                        </ul>
                    </div>
                    <!--/ End Single Widget -->
                @endif

                    <!-- Single Widget -->
                    <div class="widget categories-widget">
                        <h5 class="widget-title">{{ __lang('categories') }}</h5>
                        <ul class="custom">
                            @foreach($categories as $category)
                            <li>
                                <a href="{{ route('courses') }}?group={{ $category->id }}">{{ $category->name }} <span>{{ $category->courses()->count() }}</span></a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!--/ End Single Widget -->

                    <!-- Single Widget -->
                    <div class="widget">
                        <h5 class="widget-title">{{  __lang('Filter')  }}</h5>
                        <form id="filterform"  method="get" action="{{  route('courses') }}">

                            <input type="hidden" name="group" value="{{  $group  }}"/>

                            <div class="form-group mb-3">
                                <label  for="filter">{{  __lang('search')  }}</label>
                                {{  formElement($text)  }}
                            </div>
                            <div  class="form-group mb-3">
                                <label  for="group">{{  __lang('sort')  }}</label>
                                <div>{{  formElement($sortSelect)  }}</div>
                            </div>

                            <div   >
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> {{  __lang('filter')  }}</button>
                                <button type="button" onclick="$('#filterform input, #filterform select').val(''); $('#filterform').submit();" class="btn btn-secondary">{{  __lang('clear')  }}</button>

                            </div>

                        </form>
                    </div>
                    <!--/ End Single Widget -->

                </div>
            </aside>
            <div class="col-md-8">

                    <div class="row">
                        @if($paginator->count()==0)
                            {{ __lang('no-results') }}
                        @endif
                        @php
                            $count=4;
                        @endphp

                        @foreach($paginator as $course)
                            @php
                                $course = \App\Course::find($course->id);
                                    if($count==2){
                                        $count=4;
                                    }
                                    else{
                                        $count = 2;
                                    }
                            @endphp
                        <div class="col-lg-6 col-md-6 col-12">
                            <!-- Start Single Course -->
                            <div class="single-course wow fadeInUp" data-wow-delay=".{{ $count }}s">

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
                        @endforeach

                    </div>
                    <div class="row">
                        <div class="col-12">
                        @php
                            // add at the end of the file after the table
                                echo paginationControl(
                                // the paginator object
                                    $paginator,
                                    // the scrolling style
                                    'sliding',
                                    // the partial to use to render the control
                                    'edugrids.views.site.catalog.paginator',
                                    // the route to link to when a user clicks a control link
                                    route('courses')
                                );

                        @endphp


                        </div>
                    </div>

            </div>
        </div>
        </div>
    </section>
    <!-- End Events Area-->




@endsection
