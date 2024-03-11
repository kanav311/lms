@extends('layouts.admin')
@section('pageTitle',__('default.dashboard-theme'))

@section('innerTitle')
    @lang('default.dashboard-theme')
@endsection

@section('breadcrumb')
    @include('admin.partials.crumb',[
    'crumbs'=>[
            route('admin.dashboard')=>__('default.dashboard'),
            '#'=>__('default.dashboard-theme')
        ]])
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st">

                    <div  >
                        <div  >



                            <form class="form-inline_" method="post" action="{{ route('admin.save-dashboard-theme') }}">
                                @csrf
                                <label for="config_language">@lang('default.color')</label>
                                <div class="form-group input-group myColorPicker">

                                    <input name="color" value="{{ old('color',$color) }}" type="text" class="form-control colorpicker-full">

                                </div>
                                <button type="submit" class="btn btn-lg btn-block btn-primary">@lang('default.save')</button>
                            </form>


                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection


@section('header')

    <link href="{{ asset('client/vendor/jquery-ui-1.11.4/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('client/vendor/colorpicker/jquery.colorpicker.css') }}" rel="stylesheet">
@endsection

@section('footer')
    <script src="{{ asset('client/vendor/jquery-ui-1.11.4/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('client/vendor/colorpicker/jquery.colorpicker.js') }}"></script>



    <script>
        "use strict";
        $(document).ready(function(){


            $('.colorpicker-full').colorpicker({
                parts:          'full',
                showOn:         'both',
                buttonColorize: true,
                showNoneButton: true,
                buttonImage : '{{ asset('client/vendor/colorpicker/images/ui-colorpicker.png') }}'
            });

        });
    </script>


@endsection
