@include('admin.partials.image-input',['name'=>'image','label'=>__('te.background-image').' (1920x1360)'])
<div class="row">
    @for($i=1;$i <= 4; $i++)
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ __t('item') }} {{ $i }}</h5>
                    @include('admin.partials.text-input',['name'=>'heading'.$i,'label'=>__('te.heading')])
                    @include('admin.partials.text-input',['name'=>'text'.$i,'label'=>__('te.text')])
                </div>
            </div>
        </div>
    @endfor

</div>



