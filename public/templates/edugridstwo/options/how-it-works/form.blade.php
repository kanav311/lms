@include('admin.partials.text-input',['name'=>'heading','label'=>__('te.heading')])
@include('admin.partials.text-input',['name'=>'text','label'=>__('te.text')])
@for($i=1;$i <= 3; $i++)

    <div class="card">
        <div class="card-header">
            {{ __t('step') }} {{ $i }}
        </div>
        <div class="card-body">
            @include('admin.partials.text-input',['name'=>'heading'.$i,'label'=>__t('heading')])
            @include('admin.partials.textarea',['name'=>'text'.$i,'label'=>__('te.text')])
        </div>
    </div>


@endfor
