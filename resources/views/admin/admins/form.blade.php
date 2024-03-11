<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">@lang('default.first-name')</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ old('name',isset($admin->name) ? $admin->name : '') }}" >
    {!! clean($errors->first('name', '<p class="help-block">:message</p>')) !!}
</div>
<div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
    <label for="last_name" class="control-label">@lang('default.last-name')</label>
    <input class="form-control" name="last_name" type="text" id="name" value="{{ old('last_name',isset($admin->last_name) ? $admin->last_name : '') }}" >
    {!! clean($errors->first('last_name', '<p class="help-block">:message</p>')) !!}
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">@lang('default.email')</label>
    <input class="form-control" name="email" type="text" id="email" value="{{ old('email',isset($admin->email) ? $admin->email : '') }}" >
    {!! clean($errors->first('email', '<p class="help-block">:message</p>')) !!}
</div>
<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    <label for="password" class="control-label">@if($formMode=='edit') @lang('default.change')  @endif @lang('default.password')</label>
    <input class="form-control" name="password" type="password" id="password" value="{{ old('password') }}" >
    {!! clean($errors->first('password', '<p class="help-block">:message</p>')) !!}
</div>

    <div class="form-group">
        <label for="roles">@lang('default.role')</label>
        @if($formMode === 'edit')
            <select required name="role" id="roles" class="form-control select2">
                <option></option>
                @foreach(\App\AdminRole::get() as $role)
                    <option  @if(old('role',$admin->admin->admin_role_id)==$role->id)
                        selected
                        @endif
                        value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        @else
            <select required name="role" id="roles" class="form-control select2">
                <option></option>
                @foreach(\App\AdminRole::get() as $role)
                    <option @if(old('role')==$role->id) selected @endif value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        @endif
    </div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">@lang('default.enabled')</label>
    <select name="status" class="form-control" id="status" >
    @foreach (json_decode('{"1":"'.__('default.yes').'","0":"'.__('default.no').'"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ ((null !== old('status',@$admin->status)) && old('admin',@$admin->status) == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
    {!! clean( $errors->first('status', '<p class="help-block">:message</p>') ) !!}
</div>

<div class="form-group {{ $errors->has('about') ? 'has-error' : ''}}">
    <label for="about" class="control-label">@lang('default.about')</label>

    <textarea name="about" id="about"  class="form-control">{{ old('about',isset($admin->admin->about) ? $admin->admin->about : '') }}</textarea>
    {!! clean($errors->first('about', '<p class="help-block">:message</p>')) !!}
</div>
<div  >
    <div  >
        <div class="form-group"  >
            <div class="col-lg-8 col-md-8 col-sm-6">
            <label for="image" class="control-label">{{ __lang('profile-picture') }}</label><br />


            <div class="image"><img data-name="image" src="{{ $display_image }}" alt="" id="thumb" /><br />

                <input type="hidden" name="picture" id="image" value="">
                <a class="pointer" onclick="image_upload('image', 'thumb');">{{ __lang('browse') }}</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="pointer" onclick="$('#thumb').attr('src', '{{ $no_image }}'); $('#image').attr('value', '');">{{ __lang('clear') }}</a></div>
            </div>
        </div>
    </div>

</div>

<div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" id="notify" name="notify" value="1" @if((old('notify',isset($admin->admin->notify) ? $admin->admin->notify : 0))==1) checked @endif>

    <label class="form-check-label" for="notify">
        {{ __lang('notifications') }}
    </label>
</div>

<div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" id="public" name="public" value="1" @if((old('public',isset($admin->admin->public) ? $admin->admin->public : 0))==1) checked @endif>

    <label class="form-check-label" for="public">
        {{ __lang('public') }}
    </label>
</div>

<div class="card">
 <div class="card-header">
   <h4>{{__lang('social')}}</h4>
</div>
<div class="card-body">
    <div class="form-group {{ $errors->has('social_facebook') ? 'has-error' : ''}}">
        <label for="social_facebook" class="control-label">@lang('default.facebook')</label>
        <input class="form-control" name="social_facebook" type="text" id="social_facebook" value="{{ old('social_facebook',isset($admin->admin->social_facebook) ? $admin->admin->social_facebook : '') }}" >
        {!! clean($errors->first('social_facebook', '<p class="help-block">:message</p>')) !!}
    </div>

    <div class="form-group {{ $errors->has('social_twitter') ? 'has-error' : ''}}">
        <label for="social_twitter" class="control-label">@lang('default.twitter')</label>
        <input class="form-control" name="social_twitter" type="text" id="social_twitter" value="{{ old('social_twitter',isset($admin->admin->social_twitter) ? $admin->admin->social_twitter : '') }}" >
        {!! clean($errors->first('social_twitter', '<p class="help-block">:message</p>')) !!}
    </div>

    <div class="form-group {{ $errors->has('social_linkedin') ? 'has-error' : ''}}">
        <label for="social_linkedin" class="control-label">@lang('default.linkedin')</label>
        <input class="form-control" name="social_linkedin" type="text" id="social_linkedin" value="{{ old('social_linkedin',isset($admin->admin->social_linkedin) ? $admin->admin->social_linkedin : '') }}" >
        {!! clean($errors->first('social_linkedin', '<p class="help-block">:message</p>')) !!}
    </div>

    <div class="form-group {{ $errors->has('social_instagram') ? 'has-error' : ''}}">
        <label for="social_instagram" class="control-label">@lang('default.instagram')</label>
        <input class="form-control" name="social_instagram" type="text" id="social_instagram" value="{{ old('social_instagram',isset($admin->admin->social_instagram) ? $admin->admin->social_instagram : '') }}" >
        {!! clean($errors->first('social_instagram', '<p class="help-block">:message</p>')) !!}
    </div>

    <div class="form-group {{ $errors->has('social_website') ? 'has-error' : ''}}">
        <label for="social_website" class="control-label">@lang('default.website')</label>
        <input class="form-control" name="social_website" type="text" id="social_website" value="{{ old('social_website',isset($admin->admin->social_website) ? $admin->admin->social_website : '') }}" >
        {!! clean($errors->first('social_website', '<p class="help-block">:message</p>')) !!}
    </div>
</div>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? __('default.update') : __('default.create') }}">
</div>


<!--container ends-->
<script type="text/javascript"><!--
    function image_upload(field, thumb) {
        $('#dialog').remove();

        $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="{{ basePath() }}/admin/filemanager?&token=true&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');

        $('#dialog').dialog({
            title: '{{addslashes(__lang('Image Manager'))}}',
            close: function (event, ui) {
                if ($('#' + field).attr('value')) {
                    $.ajax({
                        url: '{{ basePath() }}/admin/filemanager/image?&image=' + encodeURIComponent($('#' + field).val()),
                        dataType: 'text',
                        success: function(data) {
                            $('#' + thumb).replaceWith('<img src="' + data + '" alt="" id="' + thumb + '" />');
                        }
                    });
                }
            },
            bgiframe: false,
            width: 800,
            height: 570,
            resizable: true,
            modal: false,
            position: "center"
        });
    };

    //--></script>
