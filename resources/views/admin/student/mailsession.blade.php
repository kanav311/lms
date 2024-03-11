@extends('layouts.admin')
@section('page-title','')
@section('breadcrumb')
    @include('admin.partials.crumb',[
    'crumbs'=>[
            route('admin.dashboard')=>__('default.dashboard'),
            route('admin.student.sessions')=>__('default.courses'),
            '#'=>__lang('send-message')
        ]])
@endsection

@section('content')
<div>
          <ul class="nav nav-pills" id="myTab3" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-envelope"></i> {{ __lang('email') }}</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-mobile"></i> {{ __lang('sms') }}</a>
                                </li>
                              </ul>
                              <div class="tab-content" id="myTabContent2">
                                <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">

                                    <div class="card">
                                        <div class="card-header">
                                            {{ $subTitle  }}
                                        </div>
                                        <div class="card-body">
                                            <form method="post" class="form-horizontal" action="{{  adminUrl(array('controller'=>'student','action'=>'mailsession','id'=>$id)) }}">
                                                @csrf



                                                <div class="form-group">
                                                    <label>{{ __lang('sender-name') }}</label>
                                                    <input required="required" name="name" class="form-control" type="text" value="{{ $senderName }}" />
                                                </div>




                                                <div class="form-group">
                                                    <label>{{ __lang('sender-email') }}</label>
                                                    <input  required="required"  name="senderEmail" class="form-control" type="text" value="{{ $senderEmail }}" />

                                                </div>

                                                <div class="form-group">
                                                    <label>{{ __lang('subject') }}</label>
                                                    <input name="subject" class="form-control" type="text" value="" />

                                                </div>



                                                <div class="form-group">
                                                    <label>{{ __lang('message') }}</label>
                                                    <textarea class="form-control" name="message" id="message" cols="30" rows="10"></textarea>
                                                </div>




                                                <div class="form-footer">
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-envelope"></i> {{ __lang('send-now') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>





                                </div>
                                <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                                    @php if(getSetting('sms_enabled')==1): @endphp
                                 <div class="card">
                                    <div class="card-header">
                                        {{$smsTitle}}
                                    </div>
                                    <div class="card-body">
                                        <form class="form" method="post" action="{{ adminUrl( ['controller' => 'session', 'action' => 'smssession','id'=>$id]) }}">
@csrf
                                            <div class="form-group">
                                                <label for="gateway">{{ __lang('gateway') }}</label>
                                                <select required name="gateway" id="gateway" class="form-control">
                                                    <option value=""></option>
                                                    @foreach($gateways as $gateway)
                                                        <option @if(old('gateway')==$gateway->id) selected @endif value="{{ $gateway->id }}">{{ $gateway->gateway_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="smsmessage">{{ __lang('message') }}</label>
                                                <textarea  required name="message" id="smsmessage" cols="30" rows="10" class="form-control">{{ old('message') }}</textarea>
                                                <p>
                                                    <span id="remaining">160 {{ __lang('characters-remaining') }}</span>
                                                    <span id="messages">1 {{ __lang('messages') }}</span>
                                                </p>
                                            </div>

                                            <button class="btn btn-primary" type="submit">{{ __lang('send') }}</button>
                                        </form>
                                    </div>
                                </div>

                                    @php else:  @endphp
                                    {{ __lang('sms-disabled') }}.  @can('access','configure_sms_gateways') {!! clean(__lang('click-to-configure',['link'=>adminUrl(array('controller'=>'smsgateway','action'=>'index'))])) !!}@endcan
                                    @php endif;  @endphp

                                </div>
                              </div>


</div>


@endsection

@section('footer')
    <script type="text/javascript" src="{{ asset('client/vendor/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">

        CKEDITOR.replace('message', {
            filebrowserBrowseUrl: '{{ basePath() }}/admin/filemanager',
            filebrowserImageBrowseUrl: '{{ basePath() }}/admin/filemanager',
            filebrowserFlashBrowseUrl: '{{ basePath() }}/admin/filemanager'
        });

        $(document).ready(function(){
            var $remaining = $('#remaining'),
                $messages = $remaining.next();

            $('#smsmessage').keyup(function(){
                var chars = this.value.length,
                    messages = Math.ceil(chars / 160),
                    remaining = messages * 160 - (chars % (messages * 160) || messages * 160);

                $remaining.text(remaining + ' {{ __lang('characters-remaining') }}');
                $messages.text(messages + ' {{ __lang('messages') }}');
            });
        });

    </script>

@endsection
