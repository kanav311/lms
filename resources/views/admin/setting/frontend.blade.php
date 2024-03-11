@extends('layouts.admin')
@section('pageTitle',__('default.disable-frontend'))

@section('innerTitle')
    @lang('default.frontend')
@endsection

@section('breadcrumb')
    @include('admin.partials.crumb',[
    'crumbs'=>[
            route('admin.dashboard')=>__('default.dashboard'),
            '#'=>__('default.disable-frontend')
        ]])
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st">

                    <div  >
                        <div  >



                            <form class="form-inline_" method="post" action="{{ route('admin.save-frontend') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="config_language">@lang('default.status')</label>
                                    <select class="form-control" name="status" id="frontend_status">
                                        @foreach($options as $key=>$value)
                                            <option @if(old('status',$status)==$key) selected @endif value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">@lang('default.save')</button>
                            </form>


                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection

