@include('admin.partials.text-input',['name'=>'client_id','label'=>__lang('paypal-client-id')])
@include('admin.partials.text-input',['name'=>'secret','label'=>__lang('paypal-secret')])
@include('admin.partials.select',['name'=>'mode','label'=>__lang('mode'),'options'=>['1'=>__lang('live'),'0'=>__lang('test')]])
<hr>
<h5>@lang('default.options')</h5>
@include('admin.partials.select',['name'=>'venmo','label'=>'Venmo','options'=>['0'=>__lang('no'),'1'=>__lang('yes')]])
@include('admin.partials.select',['name'=>'paylater','label'=>'Pay Later','options'=>['0'=>__lang('no'),'1'=>__lang('yes')]])

<hr>
