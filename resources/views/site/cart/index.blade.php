@extends('layouts.cart')
@section('page-title',__lang('cart'))

@section('content')
    <div class="card card-primary">
     <div class="card-header">
        <h4>{{ __lang('your-cart') }}</h4>
         <div class="card-header-action">

             <div class="dropdown">
                 <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">{{ __lang('select-currency') }}</a>
                 <div class="dropdown-menu">
                     @foreach($currencies as $currency)
                     <a href="{{ route('cart.currency',['currency'=>$currency->id]) }}" class="dropdown-item has-icon">{{ $currency->country->symbol_left }} - {{ $currency->country->currency_name }}</a>
                         @endforeach
                 </div>
             </div>
         </div>
    </div>
    <div class="card-body">
        @if(getCart()->hasItems())
            <div class="table-responsive">
        <table class="table table-hover mb-3">
            <thead>
            <tr>
                <th>{{  __lang('item')  }}</th>
                <th class="text-center">{{  __lang('total')  }}</th>
                <th> </th>
            </tr>
            </thead>
            <tbody>
            @php  foreach(getCart()->getSessions() as $session): @endphp
            <tr  >
                <td class="col-sm-8 col-md-6 pt-2" >
                    <div class="media">

                        @php
                                $url= route('course',['course'=>$session->id,'slug'=>safeUrl($session->name)]);

                        @endphp

                        @php  if(!empty($session->picture)):  @endphp


                        <a class="thumbnail float-left" href="{{  $url }}"> <img class="media-object" src="{{  resizeImage($session->picture,72,72,url('/')) }}" style="width: 72px; height: 72px;"> </a>

                        @php  endif;  @endphp



                        <div class="media-body pl-3">
                            <h5 class="media-heading"><a href="{{ $url }}">{{ $session->name }}</a></h5>

                            <span></span><span class="text-success"><strong>@php
                                        switch($session->type){
                                            case 'b':
                                                echo __lang('training-online');
                                                break;
                                            case 's':
                                                echo __lang('training-session');
                                                break;
                                            case 'c':
                                                echo __lang('online-course');
                                                break;
                                        }
                                    @endphp</strong></span>
                        </div>
                    </div></td>

                <td class="col-sm-1 col-md-1 text-center pt-2"  ><strong>{{ price($session->fee) }}</strong></td>
                <td class="col-sm-1 col-md-1 pt-2"  >

                    <a class="btn btn-danger" href="{{ route('cart.remove',['course'=>$session->id]) }}"><i class="fa fa-trash"></i> {{  __lang('remove')  }}</a>

                </td>
            </tr>
            @php  endforeach;  @endphp

            @foreach(getCart()->getCertificates() as $certificate)

                <tr>
                    <td class="col-sm-8 col-md-6 pt-2" >
                        {{ $certificate->name }}
                    </td>
                    <td class="col-sm-1 col-md-1 text-center pt-2"  ><strong>{{ price($certificate->price) }}</strong></td>
                    <td class="col-sm-1 col-md-1 pt-2"  >

                        <a class="btn btn-danger" href="{{ route('cart.remove-certificate',['certificate'=>$certificate->id]) }}"><i class="fa fa-trash"></i> {{  __lang('remove')  }}</a>

                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>
    </div>
            <div class="row">

            <div class="col-md-3">
                @if($cart->isCourse())
                <div class="card card-primary">
                    <div class="card-header">{{  __lang('coupon')  }}</div>
                    <div class="card-body">
                        <form method="post" class="form" action="{{  route('cart')  }}">
                            @csrf
                            <div class="form-group">
                                <label for="code">{{  __lang('coupon-code')  }}</label>
                                <input required="required" class="form-control" type="text" name="code" placeholder="{{  __lang('enter-coupon-code')  }}"/>
                            </div>
                            <button type="submit" class="btn btn-primary">{{  __lang('apply')  }}</button>
                        </form>
                    </div>
                </div>
                    @endif
            </div>


                <div class="col-md-5">
                    <form action="{{ route('cart.process') }}" method="post" id="cart-form">
                        @csrf
                        @if($cart->requiresPayment())
                    <div class="card card-success">
                        <div class="card-header" >{{  __lang('payment-method')  }}</div>
                        <div class="card-body">


                            <table class="table table-striped">
                                @php  $count = 0;  @endphp
                                @foreach($paymentMethods as $method)
                                <tr>
                                    <td><input  id="method-{{ $method->payment_method_id }}"   @php  if($count==0): @endphp  checked="checked" @php  endif;  @endphp required="required" type="radio" name="payment_method" value="{{  $method->payment_method_id  }}"/> </td>
                                    <td><label for="method-{{ $method->payment_method_id }}">{{  $method->label  }}</label></td>
                                </tr>
                                @php  $count++;  @endphp
                                @endforeach
                            </table>

                        </div>
                    </div>
                        @endif
                 </form>
                </div>

                <div class="col-md-4 ">
                    <table class="table table-hover">
                        @if(getCart()->hasDiscount())
                        <tr>
                            <td>{{  __lang('discount')  }}</td>
                            <td>@if(getCart()->discountType()=='P') {{ getCart()->getDiscount() }}% @else
                                {{ price(getCart()->getDiscount()) }}
                                @endif <a href="{{ route('cart.remove-coupon') }}">{{  strtolower(__lang('remove'))  }}</a></td>
                        </tr>
                        @endif
                        <tr>

                            <td><h3>{{  __lang('total')  }}</h3></td>
                            <td class="text-right"><h3><strong>{{ price(getCart()->getCurrentTotal()) }}</strong></h3></td>
                        </tr>
                    </table>
                    <div class="row">
                        <div class="col-md-6"  >
                            <a class="btn btn-link btn-block" href="@if(getCart()->isCertificate()){{ route('student.student.certificates')  }}@else{{ route('courses') }}@endif">
                                <i class="fa fa-cart-plus"></i> {{  __lang('continue-shopping')  }}
                            </a>

                        </div>
                        <div class="col-md-6"    >
                            <button type="button" onclick="$('#cart-form').submit()" class="btn btn-success btn-block">
                                <i class="fa fa-money-bill"></i>  {{  __lang('checkout')  }}
                            </button>
                        </div>
                    </div>
                </div>

        </div>
        @else
            <div class="text-center"><h4>{{ __lang('empty-cart') }}</h4></div>
        @endif
    </div>
    </div>
@endsection
