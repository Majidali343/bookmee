
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Third Party Scripts Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Third Party Scripts Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.general.scripts.settings')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="site_third_party_tracking_code"><?php echo e(__('Third Party Api Code')); ?></label>
                                <textarea name="site_third_party_tracking_code" id="site_third_party_tracking_code" cols="30" rows="10" class="form-control"><?php echo e(get_static_option('site_third_party_tracking_code')); ?></textarea>
                                <p><?php echo e(__('this code will be load before </head> tag')); ?></p>
                            </div>
                            <div class="form-group">
                                <label for="site_google_analytics"><?php echo e(__('Google Analytics')); ?></label>
                                <textarea type="text" name="site_google_analytics"  class="form-control" cols="30" rows="10"  id="site_google_analytics"><?php echo get_static_option('site_google_analytics'); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="site_google_captcha_v3_site_key"><?php echo e(__('Google Captcha V3 Site Key')); ?></label>
                                <input type="text" name="site_google_captcha_v3_site_key"  class="form-control" value="<?php echo e(get_static_option('site_google_captcha_v3_site_key')); ?>" id="site_google_captcha_v3_site_key">
                            </div>
                            <div class="form-group">
                                <label for="site_google_captcha_v3_secret_key"><?php echo e(__('Google Captcha V3 Secret Key')); ?></label>
                                <input type="text" name="site_google_captcha_v3_secret_key"  class="form-control" value="<?php echo e(get_static_option('site_google_captcha_v3_secret_key')); ?>" id="site_google_captcha_v3_secret_key">
                            </div>
                            <div class="form-group">
                                <label for="tawk_api_key"><?php echo e(__('Tawk.to API')); ?></label>
                                <textarea name="tawk_api_key" id="tawk_api_key" cols="30" rows="10" class="form-control"><?php echo e(get_static_option('tawk_api_key')); ?></textarea>
                            </div>

                           
                            <div class="form-group">
                                <label for="enable_facebook_login"><strong><?php echo e(__('Enable/Disable Facebook Login')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="enable_facebook_login"  <?php if(!empty(get_static_option('enable_facebook_login'))): ?> checked <?php endif; ?> >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="facebook_client_id"><?php echo e(__('Facebook Client ID')); ?></label>
                                <input type="text" name="facebook_client_id"  class="form-control" value="<?php echo e(get_static_option('facebook_client_id')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="facebook_client_secret"><?php echo e(__('Facebook Client Secret')); ?></label>
                                <input type="text" name="facebook_client_secret"  class="form-control" value="<?php echo e(get_static_option('facebook_client_secret')); ?>">
                            </div>
                            <p class="info-text"><?php echo e(__('facebook callback url for your app')); ?> <code><?php echo e(url('/')); ?>/facebook/callback</code>
                                    <a href="https://bytesed.com/docs/facebook-login/" target="_blank"><i class="fas fa-external-link-alt"></i></a></p>
                            <div class="form-group">
                                <label for="enable_google_login"><strong><?php echo e(__('Enable/Disable Google Login')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="enable_google_login"  <?php if(!empty(get_static_option('enable_google_login'))): ?> checked <?php endif; ?> >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="google_client_id"><?php echo e(__('Google Client ID')); ?></label>
                                <input type="text" name="google_client_id"  class="form-control" value="<?php echo e(get_static_option('google_client_id')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="google_client_secret"><?php echo e(__('Google Client Secret')); ?></label>
                                <input type="text" name="google_client_secret"  class="form-control" value="<?php echo e(get_static_option('google_client_secret')); ?>">
                            </div>
                            <p class="info-text"><?php echo e(__('google callback url for your app')); ?> <code><?php echo e(url('/')); ?>/google/callback</code>
                                    <a href="https://bytesed.com/docs/google-login/" target="_blank"><i class="fas fa-external-link-alt"></i></a></p>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/backend/general-settings/thid-party.blade.php ENDPATH**/ ?>