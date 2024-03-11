
@include('admin.partials.textarea',['name'=>'text','label'=>__('te.text')])
@include('admin.partials.textarea',['name'=>'newsletter-code','label'=>__('te.newsletter-code')])

@include('admin.partials.color-picker',['name'=>'bg_color','label'=>__('te.background-color')])
@include('admin.partials.color-picker',['name'=>'font_color','label'=>__('te.font-color')])
@include('admin.partials.image-input',['name'=>'image','label'=>__('te.background-image')])
@include('admin.partials.select',['name'=>'blog','label'=>__lang('blog'),'options'=>array('1'=>__('default.enabled'),'0'=>__('default.disabled'))])




<h5>@lang('te.social')</h5>
@foreach(['facebook','twitter','instagram','youtube','linkedin'] as $value)
    @include('admin.partials.text-input',['name'=>'social_'.$value,'label'=>ucfirst($value)])
@endforeach
<h5>{{ __t('credits-section') }}</h5>
@include('admin.partials.text-input',['name'=>'credits','label'=>__('te.credits')])
@include('admin.partials.color-picker',['name'=>'credits_bg_color','label'=>__('te.background-color')])
@include('admin.partials.color-picker',['name'=>'credits_font_color','label'=>__('te.font-color')])


