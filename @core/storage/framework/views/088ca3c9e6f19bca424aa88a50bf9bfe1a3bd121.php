<?php if(!empty(get_static_option('site_gdpr_cookie_enabled'))): ?>
    <script src="<?php echo e(asset('assets/frontend/js/jquery.ihavecookies.min.js')); ?>"></script>
    <?php $gdpr_cookie_link = str_replace('{url}',url('/'),get_static_option('site_gdpr_cookie_more_info_link')) ?>
    <script>

        $(document).ready(function () {
            var delayTime = "<?php echo e(get_static_option('site_gdpr_cookie_delay')); ?>";
            delayTime = delayTime ? delayTime : 4000;
            <?php
                $all_title_fields = get_static_option('site_gdpr_cookie_manage_item_title');
                $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields,['class' => false]) : [''];
                $all_description_fields = get_static_option('site_gdpr_cookie_manage_item_description');
                $all_description_fields = !empty($all_description_fields) ? unserialize($all_description_fields,['class' => false]) : [];
                $cookie_mange_data = [];
            ?>
            <?php $__currentLoopData = $all_title_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $cookie_mange_data[] = [
                    'type' => $title,
                    'value' => $title,
                    'description' => $all_description_fields[$index] ?? '',
                ];
            ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                // $.gdprcookie/
            $('body').ihavecookies({
                title: "<?php echo e(get_static_option('site_gdpr_cookie_title')); ?>",
                message: `<?php echo e(get_static_option('site_gdpr_cookie_message')); ?>`,
                expires: "<?php echo e(get_static_option('site_gdpr_cookie_expire')); ?>",
                link: "<?php echo e($gdpr_cookie_link); ?>",
                delay: delayTime,
                moreInfoLabel: "<?php echo e(get_static_option('site_gdpr_cookie_more_info_label')); ?>",
                acceptBtnLabel: "<?php echo e(get_static_option('site_gdpr_cookie_accept_button_label')); ?>",
                advancedBtnLabel: "<?php echo e(get_static_option('site_gdpr_cookie_decline_button_label')); ?>",
                cookieTypes: <?php echo json_encode($cookie_mange_data); ?>,
                moreBtnLabel: "<?php echo e(get_static_option('site_gdpr_cookie_manage_button_label',"Manage")); ?>",
                cookieTypesTitle: "<?php echo e(get_static_option('site_gdpr_cookie_manage_title',"Manage Cookies")); ?>",
            });
            $('body').on('click', '#gdpr-cookie-close', function (e) {
                e.preventDefault();
                $(this).parent().remove();
            });
        });
    </script>
<?php endif; ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/partials/gdpr-cookie.blade.php ENDPATH**/ ?>