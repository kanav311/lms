@extends(TLAYOUT)

@section('page-title',$pageTitle)
@section('inline-title',$pageTitle)

@section('content')

    <section class="ftco-section">
        <div class="container-fluid px-4">
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
                    <div class="row">
                        @if($paginator->count()==0)
                            {{ __lang('no-results') }}
                        @endif
                        @foreach($paginator as $course)

                                <div class="col-md-4 course ftco-animate">
                                    @if(!empty($course->picture))
                                        <div class="img" style="background-image: url({{ asset($course->picture) }});"></div>
                                    @endif
                                    <div class="text pt-4">
                                        <p class="meta d-flex">
                                            <span><i class="fa fa-money-bill"></i>{{ sitePrice($course->fee) }}</span>
                                            <span><i class="icon-table mr-2"></i>{{ __lang('starts') }}: {{ showDate('d M, Y',$course->start_date) }}</span>
                                        </p>
                                        <h3><a href="{{ route('course',['course'=>$course->id,'slug'=>safeUrl($course->name)]) }}">{{ $course->name}}</a></h3>
                                        <p>{{ limitLength(strip_tags($course->short_description),100) }}</p>
                                        <p><a href="{{ route('course',['course'=>$course->id,'slug'=>safeUrl($course->name)]) }}" class="btn btn-primary">{{ __lang('details') }}</a></p>
                                    </div>
                                </div>

                            @if(false)
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
                            @endif

                        @endforeach
                    </div>

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
                                    route('courses')
                                );

                        @endphp
                    </div>
                </div>

            </div>
        </div> <!-- row -->
        </div>
    </section>




@endsection
