@extends(TLAYOUT)

@section('page-title',$pageTitle)
@section('inline-title',$pageTitle)

@section('content')


    <!-- Start Events Area-->
    <section class="courses section grid-page">
        <div class="container">
            <div class="row">
                <aside class="col-lg-4 col-md-12 col-12">
                    <div class="sidebar">
                        <!-- Single Widget -->
                        <div class="widget">
                            <h5 class="widget-title">{{  __lang('Filter')  }}</h5>
                            <form id="filterform"   method="get" action="{{  route('sessions') }}">

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
                            $count=0;
                        @endphp

                        @foreach($paginator as $course)
                            @php
                                $course = \App\Course::find($course->id);
                                    $count = $count +2;
                            @endphp
                            <div class="col-lg-6 col-md-6 col-12">
                                <!-- Start Single Course -->
                                <div class="single-course wow fadeInUp" data-wow-delay=".{{ $count }}s">

                                    <div class="course-image">
                                        @if(!empty($course->picture))
                                            <a href="{{ route('course',['course'=>$course->id,'slug'=>safeUrl($course->name)]) }}">
                                                @if(!empty($course->picture))
                                                    <img src="{{ resizeImage($course->picture,550,340)  }}" alt="{{ $course->name }}">
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

                                            <span class="tag">

                                    <a href="#">{{ __lang('starts') }}: {{ showDate('d M, Y',$course->start_date) }}</a>
                                </span>

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



    @if(false)
    <section class="about-area them-2 pb-130 pt-50 recent-area">
        <div class="container">
            <div class="row">
                <div class="col-md-3">


                    <div class="card card-default" data-toggle="card-collapse" data-open="true">
                        <div class="card-header card-collapse-trigger">
                            {{  __lang('filter')  }}
                        </div>
                        <div class="card-body">
                            <form id="filterform" class="form" role="form"  method="get" action="{{  route('sessions') }}">
                                <div class="form-group input-group margin-none">
                                    <div class=" margin-none">
                                        <input type="hidden" name="group" value="{{  $group  }}"/>

                                        <div class="form-group">
                                            <label  for="filter">{{  __lang('search')  }}</label>
                                            {{  formElement($text)  }}
                                        </div>
                                        <div  class="form-group">
                                            <label  for="group">{{  __lang('sort')  }}</label>
                                            {{  formElement($sortSelect)  }}
                                        </div>

                                        <div  >
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> {{  __lang('filter')  }}</button>
                                            <button type="button" onclick="$('#filterform input, #filterform select').val(''); $('#filterform').submit();" class="btn btn-secondary">{{  __lang('clear')  }}</button>

                                        </div>

                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>



                </div>

                <div class="col-md-9">
                    @if($paginator->count()==0)
                        {{ __lang('no-results') }}
                    @endif

                        <div class="row">
                            @foreach($paginator as $course)
                                <div class="col-xl-4 col-lg-4 col-md-6">
                                    <!-- Single course -->
                                    <div class="single-course mb-70">
                                        @if(!empty($course->picture))
                                            <div class="course-img mb-2">
                                                <a href="{{ route('course',['course'=>$course->id,'slug'=>safeUrl($course->name)]) }}"><img class="course-img img-fluid" src="{{ asset($course->picture) }}" alt="{{ $course->name }}"></a>
                                            </div>
                                        @endif
                                        <div class="course-caption">
                                            <div class="course-cap-top">
                                                <h4><a href="{{ route('course',['course'=>$course->id,'slug'=>safeUrl($course->name)]) }}">{{ $course->name}}</a></h4>
                                            </div>
                                            <div class="course-cap-mid d-flex justify-content-between">


                                                <p>
                                                    {{ __lang('starts') }}: {{ showDate('d M, Y',$course->start_date) }}

                                                    <br>
                                                    {{ limitLength(strip_tags($course->short_description),50) }}</p>
                                            </div>
                                            <div class="course-cap-bottom d-flex justify-content-between">
                                                <ul>
                                                    <li>{{ sitePrice($course->fee) }}</li>
                                                </ul>
                                                <span><a href="{{ route('course',['course'=>$course->id,'slug'=>safeUrl($course->name)]) }}" class="btn btn-primary float-right btn-sm"><i class="fa fa-info-circle"></i> {{ __lang('details') }}</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    @if(false)
                    <div class="row">

                        @foreach($paginator as $course)
                            <div class="col-xl-4 col-lg-4 col-md-6">
                                <div class="single-recent-cap mb-30 ">
                                    <div class="recent-img text-center" style="max-height: 300px">
                                        @if(!empty($course->picture))
                                            <a href="{{ route('course',['course'=>$course->id,'slug'=>safeUrl($course->name)]) }}"><img class="course-img" src="{{ asset($course->picture) }}" alt="{{ $course->name }}"></a>
                                        @endif

                                    </div>
                                    <div class="recent-cap pb-5">
                                        <span>
                                            {{ __lang('starts') }}: {{ showDate('d M, Y',$course->start_date) }}
                                        </span>
                                        <h4><a href="{{ route('course',['course'=>$course->id,'slug'=>safeUrl($course->name)]) }}">{{ $course->name}}</a></h4>
                                        <p>{{ limitLength(strip_tags($course->short_description),50) }}</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <span>{{ sitePrice($course->fee) }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="{{ route('course',['course'=>$course->id,'slug'=>safeUrl($course->name)]) }}" class="btn btn-primary float-right btn-sm"><i class="fa fa-info-circle"></i> {{ __lang('details') }}</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                        @endif
                    <div>
                        @php
                            // add at the end of the file after the table
                                echo paginationControl(
                                // the paginator object
                                    $paginator,
                                    // the scrolling style
                                    'sliding',
                                    // the partial to use to render the control
                                    null,
                                    // the route to link to when a user clicks a control link
                                    route('sessions')
                                );

                        @endphp
                    </div>
                </div>

            </div>
        </div> <!-- row -->
        </div>
    </section>
    @endif



@endsection
