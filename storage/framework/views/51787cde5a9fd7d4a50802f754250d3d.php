<?php $__env->startSection('page-title',__lang('register')); ?>

<?php $__env->startSection('page-class'); ?>
    class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2"
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($enableRegistration): ?>
    <div class="card card-primary">
        <div class="card-header"><h4><?php echo e(__lang('register')); ?></h4></div>

        <div class="card-body">
            <?php if(!empty(setting('regis_registration_instructions'))): ?>
                <div class="card-title"><?php echo clean(setting('regis_registration_instructions')); ?></div>
                <?php endif; ?>
            <form method="POST" action="<?php echo e(route('register')); ?>">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="frist_name"><?php echo e(__lang('first-name')); ?></label>
                        <input id="frist_name" type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>"   autofocus="" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="last_name"><?php echo e(__lang('last-name')); ?></label>
                        <input id="last_name" type="text" class="form-control" name="last_name"  value="<?php echo e(old('last_name')); ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="email"><?php echo e(__lang('email')); ?></label>
                        <input id="email" type="email" class="form-control" name="email"  value="<?php echo e(old('email')); ?>" required >
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="mobile_number"><?php echo e(__lang('telephone')); ?></label>
                        <div>
                            <input id="mobile_number" type="text" class="form-control" name="mobile_number"  value="<?php echo e(old('mobile_number')); ?>" required >
                        </div>

                    </div>
                </div>




                <div class="row">
                    <div class="form-group col-6">
                        <label for="password" class="d-block"><?php echo e(__lang('password')); ?></label>
                        <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" required>
                        <div id="pwindicator" class="pwindicator">
                            <div class="bar"></div>
                            <div class="label"></div>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="password2" class="d-block"><?php echo e(__lang('confirm-password')); ?></label>
                        <input id="password2" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="row">

                    <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $value= old('field_'.$field->id);
                        ?>
                        <?php if($field->type=='text'): ?>
                            <div class="form-group<?php echo e($errors->has('field_'.$field->id) ? ' has-error' : ''); ?>  col-6">
                                <label for="<?php echo e('field_'.$field->id); ?>"><?php echo e($field->name); ?> <?php if(empty($field->required)): ?>(<?php echo app('translator')->get('default.optional'); ?>)<?php endif; ?></label>
                                <input placeholder="<?php echo e($field->placeholder); ?>" <?php if(!empty($field->required)): ?>required <?php endif; ?>  type="text" class="form-control" id="<?php echo e('field_'.$field->id); ?>" name="<?php echo e('field_'.$field->id); ?>" value="<?php echo e($value); ?>">
                                <?php if($errors->has('field_'.$field->id)): ?>
                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('field_'.$field->id)); ?></strong>
                                        </span>
                                <?php endif; ?>
                            </div>
                        <?php elseif($field->type=='select'): ?>
                            <div class="form-group<?php echo e($errors->has('field_'.$field->id) ? ' has-error' : ''); ?>  col-6">
                                <label for="<?php echo e('field_'.$field->id); ?>"><?php echo e($field->name); ?> <?php if(empty($field->required)): ?>(<?php echo app('translator')->get('default.optional'); ?>)<?php endif; ?></label>
                                <?php
                                $options = nl2br($field->options);
                                $values = explode('<br />',$options);
                                $selectOptions = [];
                                foreach($values as $value2){
                                    $selectOptions[trim($value2)]=trim($value2);
                                }
                                ?>
                                <?php echo e(Form::select('field_'.$field->id, $selectOptions,$value,['placeholder' => $field->placeholder,'class'=>'form-control'])); ?>

                                <?php if($errors->has('field_'.$field->id)): ?>
                                    <span class="help-block">
                                                                                        <strong><?php echo e($errors->first('field_'.$field->id)); ?></strong>
                                                                                    </span>

                                <?php endif; ?>
                            </div>
                        <?php elseif($field->type=='textarea'): ?>
                            <div class="form-group<?php echo e($errors->has('field_'.$field->id) ? ' has-error' : ''); ?>  col-6">
                                <label for="<?php echo e('field_'.$field->id); ?>"><?php echo e($field->name); ?> <?php if(empty($field->required)): ?>(<?php echo app('translator')->get('default.optional'); ?>)<?php endif; ?></label>
                                <textarea placeholder="<?php echo e($field->placeholder); ?>" class="form-control" name="<?php echo e('field_'.$field->id); ?>" id="<?php echo e('field_'.$field->id); ?>" <?php if(!empty($field->required)): ?>required <?php endif; ?>  ><?php echo e($value); ?></textarea>
                                <?php if($errors->has('field_'.$field->id)): ?>
                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('field_'.$field->id)); ?></strong>
                                        </span>
                                <?php endif; ?>
                            </div>
                        <?php elseif($field->type=='checkbox'): ?>
                            <div class="checkbox  col-6">
                                <label>
                                    <input name="<?php echo e('field_'.$field->id); ?>" type="checkbox" value="1" <?php if($value==1): ?> checked <?php endif; ?>> <?php echo e($field->name); ?>

                                </label>
                            </div>

                        <?php elseif($field->type=='radio'): ?>
                            <?php
                            $options = nl2br($field->options);
                            $values = explode('<br />',$options);
                            $radioOptions = [];
                            foreach($values as $value3){
                                $radioOptions[$value3]=trim($value3);
                            }
                            ?>
                            <h5><strong><?php echo e($field->name); ?></strong></h5>
                            <?php $__currentLoopData = $radioOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="radio  col-6">
                                    <label>
                                        <input type="radio" <?php if($value==$value2): ?> checked <?php endif; ?>  name="<?php echo e('field_'.$field->id); ?>" id="<?php echo e('field_'.$field->id); ?>-<?php echo e($value2); ?>" value="<?php echo e($value2); ?>" >
                                        <?php echo e($value2); ?>

                                    </label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php elseif($field->type=='file'): ?>
                            <?php

                            $value='';
                            ?>


                            <div class="form-group<?php echo e($errors->has('field_'.$field->id) ? ' has-error' : ''); ?>  col-6">
                                <label for="<?php echo e('field_'.$field->id); ?>"><?php echo e($field->name); ?> <?php if(empty($field->required)): ?>(<?php echo app('translator')->get('default.optional'); ?>)<?php endif; ?></label>
                                <input placeholder="<?php echo e($field->placeholder); ?>" <?php if(!empty($field->required)): ?>required <?php endif; ?>  type="file" class="form-control" id="<?php echo e('field_'.$field->id); ?>" name="<?php echo e('field_'.$field->id); ?>" >
                                <?php if($errors->has('field_'.$field->id)): ?>
                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('field_'.$field->id)); ?></strong>
                                        </span>
                                <?php endif; ?>
                            </div>

                        <?php endif; ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>

                <?php if(setting('regis_captcha_type')=='image'): ?>
                    <div class="row">
                        <div class="form-group col-6">
                            <label><?php echo app('translator')->get('default.verification'); ?></label><br/>
                            <label for=""><span id="captacha-box"><?php echo clean( captcha_img() ); ?></span> <a id="new-captcha" href="#captacha-box"><?php echo e(__lang('try-another')); ?></a></label>
                            <input class="form-control" type="text" name="captcha" placeholder="<?php echo app('translator')->get('default.verification-hint'); ?>"/>

                        </div>

                    </div>
                <?php endif; ?>

                <?php if(setting('regis_captcha_type')=='google'): ?>
                    <input name="captcha_token" type="hidden" class="captcha_token">
                    <?php $__env->startSection('footer'); ?>
                        <?php echo \Illuminate\View\Factory::parentPlaceholder('footer'); ?>
                        <?php echo $__env->make('partials.recaptcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php $__env->stopSection(); ?>
                <?php endif; ?>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="agree" class="custom-control-input" id="agree" required <?php echo e(old('agree')? 'checked':''); ?> >
                        <label class="custom-control-label" for="agree"><?php echo __lang('i-accept-terms',['link'=>route('terms')]); ?></label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        <?php echo e(__lang('Register')); ?>

                    </button>
                </div>
                <?php if(setting('social_enable_facebook')==1 || setting('social_enable_google')==1): ?>
                    <div class="text-center mt-4 mb-3">
                        <div class="text-job text-muted"><?php echo e(__lang('Or')); ?></div>
                    </div>
                    <div class="row sm-gutters">
                        <?php if(setting('social_enable_facebook')==1): ?>
                            <div class="col-6">
                                <a href="<?php echo e(route('social.login',['network'=>'facebook'])); ?>" class="btn btn-block btn-social btn-facebook">
                                    <span class="fab fa-facebook"></span><?php echo e(__lang('login-with')); ?> <?php echo e(__lang('facebook')); ?>

                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if(setting('social_enable_google')==1): ?>
                            <div class="col-6">
                                <a href="<?php echo e(route('social.login',['network'=>'google'])); ?>" class="btn btn-block btn-social btn-google">
                                    <span class="fab fa-google"></span><?php echo e(__lang('login-with')); ?>  <?php echo e(__lang('google')); ?>

                                </a>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>

            </form>
        </div>
    </div>

        <div class="mt-5 text-muted text-center">
            <a href="<?php echo e(route('login')); ?>"><?php echo e(__lang('already-have-account')); ?></a>
        </div>
    <?php else: ?>
        <?php echo e(__lang('registration-is-disabled')); ?>

    <?php endif; ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('client/themes/admin/assets/modules/jquery-selectric/selectric.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/vendor/intl-tel-input/build/css/intlTelInput.css')); ?>">
    <style>
        .iti-flag {background-image: url("<?php echo e(asset('client/vendor/intl-tel-input/build/img/flags.png')); ?>");}

        @media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2 / 1), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {
            .iti-flag {background-image: url("<?php echo e(asset('client/vendor/intl-tel-input/build/img/flags@2x.png')); ?>");}
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <!-- JS Libraies -->
    <script src="<?php echo e(asset('client/themes/admin/assets/modules/jquery-pwstrength/jquery.pwstrength.min.js')); ?>"></script>
    <script src="<?php echo e(asset('client/themes/admin/assets/modules/jquery-selectric/jquery.selectric.min.js')); ?>"></script>

    <!-- Page Specific JS File -->
    <script src="<?php echo e(asset('client/themes/admin/assets/js/page/auth-register.js')); ?>"></script>

    <script src="<?php echo e(asset('client/vendor/intl-tel-input/build/js/intlTelInput.js')); ?>"></script>
    <script>
        $("input[name=mobile_number]").intlTelInput({
            initialCountry: "auto",
            separateDialCode:true,
            hiddenInput:'fmobilenumber',
            geoIpLookup: function(callback) {
                $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    callback(countryCode);
                });
            },
            utilsScript: "<?php echo e(asset('client/vendor/intl-tel-input/build/js/utils.js')); ?>" // just for formatting/placeholders etc
        });

        $(function(){
           $('#new-captcha').on('click',function(e){
              e.preventDefault();
               $('#captacha-box').text('<?php echo e(__lang('loading')); ?>');
              $('#captacha-box').load('<?php echo e(route('register.captcha')); ?>');
           });
        });

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\resources\views/auth/register.blade.php ENDPATH**/ ?>