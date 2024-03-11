@extends(TLAYOUT)

@section('page-title',$admin->user->name.' '.$admin->user->last_name)
@section('inline-title',$admin->user->name.' '.$admin->user->last_name)
@section('crumb')
    <li><a href="@route('instructors')">@lang('default.instructors')</a></li>
    <li>@lang('default.details')</li>
@endsection
@section('content')

    <!-- Teacher Details -->
    <div class="teacher-details-area section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <div class="teacher-personal-info">
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-md-4 col-12">
                                <div class="image">
                                    @if(empty($admin->user->picture))
                                        <img src="{{ asset('img/user.png') }}" alt="">
                                    @else
                                        <img src="{{ asset($admin->user->picture) }}" alt="">
                                    @endif

                                    <h4 class="name">{{ $admin->user->name.' '.$admin->user->last_name }}

                                    </h4>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8 col-12">
                                <div class="personal-social">
                                    <p>{!! clean($admin->about) !!}
                                    </p>
                                    <ul class="social">

                                            @if(!empty($admin->social_facebook))
                                        <li><a href="{{  fullUrl($admin->social_facebook)  }}"><i class="lni lni-facebook-original"></i></a></li>
                                            @endif
                                            @if(!empty($admin->social_twitter))
                                        <li><a href="{{  fullUrl($admin->social_twitter) }}"><i class="lni lni-twitter-original"></i></a></li>
                                            @endif
                                            @if(!empty($admin->social_linkedin))
                                        <li><a href="{{  fullUrl($admin->social_linkedin)  }}"><i class="lni lni-linkedin-original"></i></a></li>
                                            @endif
                                            @if(!empty($admin->social_instagram))
                                        <li><a href="{{  fullUrl($admin->social_instagram)  }}"><i class="lni lni-instagram-original"></i></a></li>
                                            @endif
                                            @if(!empty($admin->social_website))
                                        <li><a  href="{{  fullUrl($admin->social_website) }}"><i class="lni lni-world"></i></a></li>
                                            @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End teacher Details -->



@endsection
