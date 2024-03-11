@extends('layouts.admin')
@section('page-title','')
@section('breadcrumb')
    @include('admin.partials.crumb',[
    'crumbs'=>[
            route('admin.dashboard')=>__('default.dashboard'),
            route('admin.test.index')=>__lang('tests'),
            '#'=>isset($pageTitle)?$pageTitle:''
        ]])
@endsection

@section('content')
<div>
    <div >
        <div class="card">

            <div class="card-body">


                <form method="post" action="{{ adminUrl(array('controller'=>'test','action'=>$action,'id'=>$id)) }}">
                    @csrf

                <div class="form-group">
                    {{ formLabel($form->get('name')) }}
                    {{ formElement($form->get('name')) }}   <p class="help-block">{{ formElementErrors($form->get('name')) }}</p>

                </div>
                <div class="form-group">
                    {{ formLabel($form->get('description')) }}
                    {{ formElement($form->get('description')) }}   <p class="help-block">{{ formElementErrors($form->get('description')) }}</p>

                </div>


                <div class="form-group">
                    {{ formLabel($form->get('enabled')) }}
                    {{ formElement($form->get('enabled')) }}   <p class="help-block">{{ formElementErrors($form->get('enabled')) }}</p>

                </div>

                <div class="form-group">
                    {{ formLabel($form->get('passmark')) }}
                    {{ formElement($form->get('passmark')) }}   <p class="help-block">{{ formElementErrors($form->get('passmark')) }}</p>
                    <p class="help-block">{{ __lang('test-passmark-help') }}</p>

                </div>

                <div class="form-group">
                    {{ formLabel($form->get('minutes')) }}
                    {{ formElement($form->get('minutes')) }}   <p class="help-block">{{ formElementErrors($form->get('minutes')) }}</p>

                </div>

                <div class="form-group">
                    {{ formLabel($form->get('allow_multiple')) }}
                    {{ formElement($form->get('allow_multiple')) }}   <p class="help-block">{{ formElementErrors($form->get('allow_multiple')) }}</p>

                </div>
                <div class="form-group">
                    <input type="hidden" name="private" value="0">
                    {{ formLabel($form->get('private')) }}
                    {{ formElement($form->get('private')) }}   <p class="help-block">{{ formElementErrors($form->get('private')) }}</p>

                    <p class="help-block">{{ __lang('test-private-help') }}</p>
                </div>

                <div class="form-group">
                    <input type="hidden" name="show_result" value="0">
                    {{ formLabel($form->get('show_result')) }}
                    {{ formElement($form->get('show_result')) }}   <p class="help-block">{{ formElementErrors($form->get('show_result')) }}</p>

                    <p class="help-block">{{ __lang('test-show-result-help') }}</p>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary">{{__lang('save-changes')}}</button>
                </div>
                 </form>
            </div>
        </div><!--end .box -->
    </div><!--end .col-lg-12 -->
</div>

@endsection

@section('footer')
    <script type="text/javascript" src="{{ asset('client/vendor/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">

        CKEDITOR.replace('description', {
            filebrowserBrowseUrl: '{{ basePath() }}/admin/filemanager',
            filebrowserImageBrowseUrl: '{{ basePath() }}/admin/filemanager',
            filebrowserFlashBrowseUrl: '{{ basePath() }}/admin/filemanager'
        });

    </script>
@endsection
