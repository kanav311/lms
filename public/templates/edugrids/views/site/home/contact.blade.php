@extends(TLAYOUT)

@section('page-title',__('default.contact-us'))
@section('inline-title',__('default.contact-us'))
@section('crumb')
<li>@lang('default.contact-us')</li>
@endsection
@section('content')

    <!-- Start Contact Area -->
    <section id="contact-us" class="contact-us section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="form-main">
                        <h3 class="title">
                            @lang('default.get-in-touch-text')
                        </h3>
                        <form class="form" method="post" action="{{ route('contact.send-mail') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>{{ __t('enter-your-name') }}</label>
                                        <input name="name" type="text" placeholder="" required="required">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>{{ __t('enter-email') }}</label>
                                        <input name="email" type="email" placeholder="" required="required">
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ __t('enter-subject') }}</label>
                                        <input name="subject" type="text" placeholder=""
                                               required="required">
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="form-group message">
                                        <label>{{ __t('enter-message') }}</label>
                                        <textarea name="message" placeholder=""></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>@lang('default.verification')</label>
                                        <label for="">{!! clean( captcha_img() ) !!}</label>
                                        <input class="form-control" type="text" name="captcha" placeholder="@lang('default.verification-hint')"/>

                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="form-group button">
                                        <button type="submit" class="btn ">{{ __t('send') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="contact-info">
                        <!-- Start Single Info -->
                        <div class="single-info">
                            <i class="lni lni-map-marker"></i>
                            <h4>@lang('default.address')</h4>
                            <p class="no-margin-bottom">{!! clean(setting('general_address')) !!}</p>
                        </div>
                        <!-- End Single Info -->
                        <!-- Start Single Info -->
                        <div class="single-info">
                            <i class="lni lni-phone"></i>
                            <h4>{{ __t('lets-talk') }}</h4>
                            <p class="no-margin-bottom">@lang('default.telephone'): {{ setting('general_tel') }} </p>
                        </div>
                        <!-- End Single Info -->
                        <!-- Start Single Info -->
                        <div class="single-info">
                            <i class="lni lni-envelope"></i>
                            <h4>@lang('default.email')</h4>
                            <p class="no-margin-bottom">{!! clean( setting('general_contact_email') ) !!}</p>
                        </div>
                        <!-- End Single Info -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Contact Area -->

@endsection
