<?php $__env->startSection('page-title',__lang('login')); ?>
<?php if($enableRegistration): ?>
<?php $__env->startSection('page-class'); ?>
    class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2"
<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php $__env->startSection('content'); ?>

    <div class="card card-primary">
        <div class="card-header"><h4><?php echo e(__lang('login')); ?></h4></div>

        <div class="card-body">
            <div id="login-info-box"></div>

            <div class="row">
                <div class="col-md-<?php echo e($enableRegistration ? 6:12); ?> mb-5">
                    <form method="POST" action="<?php echo e(route('login')); ?>" class="needs-validation"   >
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="email"><?php echo e(__lang('email')); ?></label>
                            <input id="email" type="email" class="form-control login-email <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"  name="email" tabindex="1"  value="<?php echo e(old('email')); ?>"   required autofocus autocomplete="email" >

                            <div class="invalid-feedback">
                                <?php echo e(__lang('email-required')); ?>

                            </div>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group">
                            <div class="d-block">
                                <label for="password" class="control-label"><?php echo e(__lang('password')); ?></label>
                                <div class="float-right">
                                    <a href="<?php echo e(route('password.request')); ?>" class="text-small">
                                        <?php echo e(__lang('lost-password')); ?>

                                    </a>
                                </div>
                            </div>
                            <input id="password" type="password" class="form-control login-password <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" tabindex="2" required  autocomplete="current-password" >
                            <div class="invalid-feedback">
                                <?php echo e(__lang('fill-password')); ?>

                            </div>
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                        </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me"  <?php echo e(old('remember') ? 'checked' : ''); ?> >
                                <label class="custom-control-label" for="remember-me"><?php echo e(__lang('remember-me')); ?></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                <?php echo e(__lang('sign-in')); ?>

                            </button>
                        </div>
                    </form>

                    <?php if(setting('social_enable_facebook')==1 || setting('social_enable_google')==1): ?>
                        <div class="text-center mt-4 mb-3">
                            <div class="text-job text-muted"><?php echo e(__lang('social-login')); ?></div>
                        </div>
                        <div class="row sm-gutters">
                            <?php if(setting('social_enable_facebook')==1): ?>
                                <div class="col-6">
                                    <a href="<?php echo e(route('social.login',['network'=>'facebook'])); ?>" class="btn btn-block btn-social btn-facebook">
                                        <span class="fab fa-facebook"></span> <?php echo e(__lang('facebook')); ?>

                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php if(setting('social_enable_google')==1): ?>
                                <div class="col-6">
                                    <a href="<?php echo e(route('social.login',['network'=>'google'])); ?>" class="btn btn-block btn-social btn-google">
                                        <span class="fab fa-google"></span> <?php echo e(__lang('google')); ?>

                                    </a>
                                </div>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>
                </div>
                <?php if($enableRegistration): ?>
                <div class="col-md-6 text-center pt-3 pr-5 pl-5">
                    <h4><?php echo e(__lang('new-user')); ?></h4>
                    <br>
                    <h1><i class="fa fa-user"></i></h1>
                    <br>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-primary btn-block btn-lg"><?php echo e(__lang('register')); ?></a>
                </div>
                <?php endif; ?>


            </div>




        </div>
    </div>
    <?php if($enableRegistration): ?>

    <div class="mt-5 text-muted text-center">
        <?php echo e(__lang('dont-have-account')); ?> <a href="<?php echo e(route('register')); ?>"><?php echo e(__lang('create-one')); ?></a>
    </div>
    <?php endif; ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DHRUVESH TRIPATHI\Videos\base_file_aiipl\resources\views/auth/login.blade.php ENDPATH**/ ?>