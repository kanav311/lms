@include('admin.partials.text-input',['name'=>'sub_heading','label'=>__('te.sub-heading')])
@include('admin.partials.text-input',['name'=>'heading','label'=>__('te.heading')])
@include('admin.partials.rte',['name'=>'text','label'=>__('te.text')])
@include('admin.partials.text-input',['name'=>'button_text','label'=>__('te.button-text')])
@include('admin.partials.text-input',['name'=>'button_url','label'=>__('te.button-url')])

@include('admin.partials.image-input',['name'=>'image','label'=>__('te.image').' (540 x 570)'])

<hr>
<h4>{{ __t('work-experience') }}</h4>
<div class="row">
    <div class="col-md-4">
        @include('admin.partials.text-input',['name'=>'number','label'=>__t('number'),'placeholder'=>'19'])
    </div>
    <div class="col-md-4">
        @include('admin.partials.text-input',['name'=>'years','label'=>__t('years'),'placeholder'=>__t('years')])
    </div>
    <div class="col-md-4">
        @include('admin.partials.text-input',['name'=>'experience-text','label'=>__t('work-experience'),'placeholder'=>__t('work-experience')])
    </div>
</div>

<hr>
<h4>{{ __t('about-footer') }}</h4>
@include('admin.partials.textarea',['name'=>'footer_text','label'=>__('te.text')])
@include('admin.partials.text-input',['name'=>'footer_button_text','label'=>__('te.button-text')])
@include('admin.partials.text-input',['name'=>'footer_button_url','label'=>__('te.button-url')])
