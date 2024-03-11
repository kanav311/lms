@extends(TLAYOUT)

@section('page-title',$course->name)
@section('inline-title',$course->name)
@section('crumb')
    <li><a href="@route('courses')">{{ __lang('courses') }}</a></li>
    <li>{{ __lang('course-details') }}</li>
@endsection
@section('content')

    <!-- Course Details Section Start -->
    <div class="course-details section">
        <div class="container">
            <div class="row">
                <!-- Course Details Wrapper Start -->
                <div class="col-lg-8 col-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="overview-tab" data-bs-toggle="tab"
                                    data-bs-target="#overview" type="button" role="tab" aria-controls="overview"
                                    aria-selected="true">{{  __lang('details')  }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="curriculum-tab" data-bs-toggle="tab"
                                    data-bs-target="#curriculum" type="button" role="tab" aria-controls="curriculum"
                                    aria-selected="false">{{  __lang('classes')  }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="instructor-tab" data-bs-toggle="tab"
                                    data-bs-target="#instructor" type="button" role="tab" aria-controls="instructor"
                                    aria-selected="false">{{  __lang('instructors')  }}</button>
                        </li>
                        @if($course->has('certificates'))
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="certificate-tab" data-bs-toggle="tab"
                                    data-bs-target="#certificate" type="button" role="tab" aria-controls="certificate"
                                    aria-selected="false">{{  __lang('certificates')  }}</button>
                        </li>
                        @endif



                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel"
                             aria-labelledby="overview-tab">
                            <div class="course-overview">
                                <h3 class="title">{{ $course->name }}</h3>
                                <div class="text-center">
                                    @if(!empty($row->picture))
                                        <img class="rounded img-fluid img-thumbnail" src="{{  resizeImage($row->picture,400,300,url('/')) }}" >

                                    @endif
                                </div>
                                <p>
                                    {!! $row->description !!}
                                </p>


                                <div class="bottom-content">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="button">
                                                <a href="{{  route('cart.add',['course'=>$course->id])  }}" class="btn">{{  __lang('enroll')  }}</a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <ul class="share">
                                                <li><span>@if(setting('general_show_fee')==1) @if(empty($row->payment_required)){{  __lang('free')  }}@else{{ price($row->fee) }}@endif @endif</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="curriculum" role="tabpanel" aria-labelledby="curriculum-tab">
                            @php  $sessionVenue= $row->venue;  @endphp
                            <div class="course-curriculum">
                                <ul class="curriculum-sections">

                                    @foreach($rowset as $row2)
                                    <li class="single-curriculum-section">
                                        <div class="section-header">
                                            <div class="section-left">

                                                <h5 class="title">{{  $row2->name }}
                                                    @if(!empty($row2->lesson_date))
                                                         :   {{  __lang('starts')  }} {{  showDate('d/M/Y',$row2->lesson_date) }}
                                                    @endif

                                                </h5>

                                            </div>
                                        </div>
                                        <div class="row pt-2 pb-2 pr-3 pl-3">
                                            @php  if(!empty($row2->picture)):  @endphp
                                            <div class="col-md-3">
                                                <a href="#" >
                                                    <img class="img-fluid  rounded" src="{{  resizeImage($row2->picture,300,300,url('/')) }}" >
                                                </a>
                                            </div>
                                            @php  endif;  @endphp

                                            <div class="{{  (empty($row2->picture)? 'col-md-12 ps-5':'col-md-9')  }} pb-5">
                                                <article class="readmore" >{!! $row2->description !!}  </article>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach


                                </ul>
                                <div class="bottom-content">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="button">
                                                <a href="{{  route('cart.add',['course'=>$course->id])  }}" class="btn">{{  __lang('enroll')  }}</a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <ul class="share">
                                                <li><span>@if(setting('general_show_fee')==1) @if(empty($row->payment_required)){{  __lang('free')  }}@else{{ price($row->fee) }}@endif @endif</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="instructor" role="tabpanel" aria-labelledby="instructor-tab">

                            @foreach($instructors as $instructor)
                            <div class="course-instructor">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="profile-image">
                                            <img src="{{ profilePictureUrl($instructor->user_picture) }}" alt="#">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="profile-info">
                                            <h5><a href="{{ route('instructor',['admin'=>$instructor->admin_id]) }}">{{  $instructor->name.' '.$instructor->last_name  }}</a></h5>
                                            <p class="author-career">{{ \App\Admin::find($instructor->admin_id)->adminRole->name }}</p>
                                            <p class="author-bio">{!! clean($instructor->about) !!}</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="bottom-content">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="button">
                                            <a href="{{  route('cart.add',['course'=>$course->id])  }}" class="btn">{{  __lang('enroll')  }}</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <ul class="share">
                                            <li><span>@if(setting('general_show_fee')==1) @if(empty($row->payment_required)){{  __lang('free')  }}@else{{ price($row->fee) }}@endif @endif</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($course->has('certificates'))
                            <div class="tab-pane fade" id="certificate" role="tabpanel" aria-labelledby="certificate-tab">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{ __lang('certificate') }}</th>
                                        <th>{{ __lang('price') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($course->certificates()->where('enabled',1)->get() as $certificate )
                                        <tr>
                                            <td>{{ $certificate->name }}</td>
                                            <td>{{ price($certificate->price) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- End Course Details Wrapper -->
                <!-- Start Course Sidebar -->
                <div class="col-lg-4 col-12">
                    <div class="course-sidebar">
                        <div class="sidebar-widget">
                            <table id="course-specs" class="table table-striped">
                                @php  if(!empty($row->session_date)): @endphp
                                <tr>
                                    <td >{{  __lang('starts')  }}</td>
                                    <td  >{{  showDate('d/M/Y',$row->session_date) }}</td>
                                </tr>
                                @php  endif;  @endphp

                                @php  if(!empty($row->session_end_date)): @endphp
                                <tr>
                                    <td >{{  __lang('ends')  }}</td>
                                    <td>{{  showDate('d/M/Y',$row->session_end_date) }}</td>
                                </tr>
                                @php  endif;  @endphp
                                @php  if(!empty($row->enrollment_closes)): @endphp
                                <tr>
                                    <td >{{  __lang('enrollment-closes')  }}</td>
                                    <td>{{  showDate('d/M/Y',$row->enrollment_closes) }}</td>
                                </tr>
                                @php  endif;  @endphp

                                @php  if(!empty($row->length)): @endphp
                                <tr>

                                    <td>{{  __lang('length')  }}</td>
                                    <td>{{  $row->length }}</td>
                                </tr>
                                @php  endif;  @endphp


                                @php  if(!empty($row->effort)): @endphp
                                <tr>

                                    <td>{{  __lang('effort')  }}</td>
                                    <td>{{  $row->effort }}</td>
                                </tr>
                                @php  endif;  @endphp
                                @php  if(!empty($row->enable_chat)): @endphp
                                <tr>

                                    <td>{{  __lang('live-chat')  }}</td>
                                    <td>{{  __lang('enabled')  }}</td>
                                </tr>
                                @php  endif;  @endphp
                                @php  if(setting('general_show_fee')==1): @endphp
                                <tr>
                                    <td>{{  __lang('fee')  }}</td>
                                    <td>@php  if(empty($row->payment_required)): @endphp
                                        {{  __lang('free')  }}
                                        @php  else:  @endphp
                                        {{  price($row->fee) }}
                                        @php  endif;  @endphp</td>
                                </tr>
                                @php  endif;  @endphp





                            </table>
                            <div class="button">
                                <a href="{{  route('cart.add',['course'=>$course->id])  }}" class="btn btn-block"><i class="fa fa-cart-plus"></i>  {{  __lang('enroll')  }}</a>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- End Course Sidebar -->
            </div>
        </div>
    </div>
    <!-- Course Details Section End -->




@endsection
