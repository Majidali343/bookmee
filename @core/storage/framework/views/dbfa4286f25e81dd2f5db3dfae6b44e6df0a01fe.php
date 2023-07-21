

<?php $__env->startSection('page-meta-data'); ?>
    <title><?php echo e(__('User Login')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="signup-area padding-top-70 padding-bottom-100">
    <div class="container">
        <div class="signup-wrapper">
            <div class="signup-contents">
                <h3 class="signup-title"> <?php echo e(get_static_option('login_form_title') ?? __('Login to your account')); ?></h3>

                <?php if(Session::has('msg')): ?>
                <p class="alert alert-<?php echo e(Session::get('type') ?? 'success'); ?>"><?php echo e(Session::get('msg')); ?></p>
                <?php endif; ?>
                <div class="error-message"></div>

                <form class="signup-forms" action="<?php echo e(route('user.send.login.otp')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="single-signup margin-top-30">
                        <label class="signup-label"> <?php echo e(__('Phone Number')); ?> </label>
                        <div style="display: flex">
                            <input class="form--control" type="text" name="phone_number" value="+91" readonly style="width: 43px; padding: 0px 0px 0px 6px; margin-right:8px;">
                            <input class="form--control" type="text" name="phone" id="phone" placeholder="<?php echo e(__('Phone Number')); ?>"  >
                        </div>
                    </div>

                    <div class="signup-checkbox">
                        <div class="checkbox-inlines">
                            <input class="check-input" name="remember" id="remember" type="checkbox" id="check8">
                            <label class="checkbox-label" for="remember"> <?php echo e(__('Remember me')); ?></label>
                        </div>
                        <!-- <div class="forgot-btn">
                            <a href="<?php echo e(route('user.forget.password')); ?>" class="forgot-pass"> <?php echo e(__('Forgot Password')); ?></a>
                        </div> -->
                    </div>
                    <button id="signin_form" type="submit" style="background-color:rgba(3, 152, 158, 1);"><?php echo e(__('Login Now')); ?></button>
                    <span class="bottom-register"> <?php echo e(_('Do not have Account?')); ?> <a class="resgister-link" href="<?php echo e(route('user.register')); ?>"> <?php echo e(_('Register')); ?> </a> </span>
                </form>
                
                <!-- <?php if(preg_match('/(bytesed)/',url('/'))): ?>
                <div class="adminlogin-info table-responsive margin-top-30">
                    <table class="table-border table">
                        <th><?php echo e(__('Username')); ?></th>
                        <th><?php echo e(__('Password')); ?></th>
                        <th><?php echo e(__('Action')); ?></th>
                        <tbody>
                            <tr>
                                <td id="seller_username">test_seller</td>
                                <td id="seller_password">12345678</td>
                                <td><button type="button" class="autoLogin" id="sellerLogin"><?php echo e(__('Seller Login')); ?></button></td>
                            </tr>
                            <tr>
                                <td id="buyer_username">test_buyer</td>
                                <td id="buyer_password">12345678</td>
                                <td><button type="button" class="autoLogin" id="buyerLogin"><?php echo e(__('Buyer Login')); ?></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?> -->

                <!-- <div class="social-login-wrapper">
                    <?php if(get_static_option('enable_google_login') || get_static_option('enable_facebook_login')): ?>
                    <div class="bar-wrap">
                        <span class="bar"></span>
                        <p class="or"><?php echo e(__('or')); ?></p>
                        <span class="bar"></span>
                    </div>
                    <?php endif; ?>

                    <div class="sin-in-with">
                        <?php if(get_static_option('enable_google_login')): ?>
                        <a href="<?php echo e(route('login.google.redirect')); ?>" class="sign-in-btn">
                            <img src="<?php echo e(asset('assets/frontend/img/static/google.png')); ?>" alt="icon">
                            <?php echo e(__('Sign in with Google')); ?>

                        </a>
                        <?php endif; ?>
                        <?php if(get_static_option('enable_facebook_login')): ?>
                        <a href="<?php echo e(route('login.facebook.redirect')); ?>" class="sign-in-btn">
                            <img src="<?php echo e(asset('assets/frontend/img/static/facebook.png')); ?>" alt="icon">
                            <?php echo e(__('Sign in with Facebook')); ?>

                        </a>
                        <?php endif; ?>
                    </div>
                </div> -->

            </div>
        </div>
    </div>
</div>
 


<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.frontend-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/user/login.blade.php ENDPATH**/ ?>