@for($i=1;$i <= 12; $i++)

    <div class="row">
        <div class="col-md-4">
            @include('admin.partials.image-input',['name'=>'image'.$i,'label'=>__('te.image').' '.$i.' (230x95)'])
        </div>
    </div>

@endfor
