@extends(TLAYOUT)

@section('page-title',__('default.instructors'))
@section('inline-title',__('default.instructors'))
@section('crumb')
    <li>@lang('default.instructors')</li>
@endsection

@section('content')

    <!-- Start Teachers -->
    <section id="teachers" class="teachers section">
        <div class="container">

            <div class="row">

                @foreach($admins as $admin)
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
                                        <img src="{{ asset($admin->user->picture) }}" alt="">
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
                @endforeach

            </div>
        </div>
    </section>
    <!--/ End Teachers Area -->



@endsection
