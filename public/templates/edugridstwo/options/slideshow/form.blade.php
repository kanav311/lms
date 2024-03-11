

<div class="card">

    <div class="card-body">
        @include('admin.partials.image-input',['name'=>'file','label'=>__('te.image').' (1920 x 800)'])
        <div class="row">
            <div class="col-md-12">
                @include('admin.partials.text-input',['name'=>'heading','label'=>__t('heading')])
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                @include('admin.partials.text-input',['name'=>'sub_heading','label'=>__t('sub-heading')])
            </div>
            <div class="col-md-6">
                @include('admin.partials.color-picker',['name'=>'heading_font_color','label'=>__t('heading-color')])
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                @include('admin.partials.textarea',['name'=>'text','label'=>__t('text')])
            </div>
            <div class="col-md-6">
                @include('admin.partials.color-picker',['name'=>'text_font_color','label'=>__t('text-color')])
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <h5>{{ __t('button') }}</h5>
                @include('admin.partials.text-input',['name'=>'button_text','label'=>__t('button-text')])
                @include('admin.partials.text-input',['name'=>'url','label'=>__t('link')])
            </div>

        </div>



    </div>
</div>



