

<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.css','data' => []]); ?>
<?php $component->withName('media.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/summernote-bs4.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Payment Gateway Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Payment Gateway Settings")); ?></h4>
                        <?php echo $__env->make('backend/partials/error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <form action="<?php echo e(route('admin.general.payment.settings')); ?>" method="POST"
                              enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="site_global_currency"><?php echo e(__('Site Global Currency')); ?></label>
                                        <select name="site_global_currency" class="form-control" id="site_global_currency">

                                            <?php $__currentLoopData = Xgenious\Paymentgateway\Facades\XgPaymentGateway::script_currency_list(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cur => $symbol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($cur); ?>"
                                                        <?php if(get_static_option('site_global_currency') == $cur): ?> selected <?php endif; ?>
                                                >
                                                    <?php echo e($cur.' ( '.$symbol.' )'); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="site_global_currency"><?php echo e(__('Enable/Disable Decimal Point')); ?></label>
                                        <select name="enable_disable_decimal_point" class="form-control" id="enable_disable_decimal_point">
                                            <option value="yes" <?php echo e(get_static_option('enable_disable_decimal_point') == 'yes' ? 'selected' : ''); ?>><?php echo e(__('Yes')); ?></option>
                                            <option value="no" <?php echo e(get_static_option('enable_disable_decimal_point') == 'no' ? 'selected' : ''); ?>><?php echo e(__('No')); ?></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="site_global_currency"><?php echo e(__('Add/Remove Space Between Currency Symbol and Amount')); ?></label>
                                        <select name="add_remove_sapce_between_amount_and_symbol" class="form-control">
                                            <option value="yes" <?php echo e(get_static_option('add_remove_sapce_between_amount_and_symbol') == 'yes' ? 'selected' : ''); ?>><?php echo e(__('Yes')); ?></option>
                                            <option value="no" <?php echo e(get_static_option('add_remove_sapce_between_amount_and_symbol') == 'no' ? 'selected' : ''); ?>><?php echo e(__('No')); ?></option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="site_currency_symbol_position"><?php echo e(__('Currency Symbol Position')); ?></label>
                                        <?php $all_currency_position = ['left','right']; ?>
                                        <select name="site_currency_symbol_position" class="form-control"
                                                id="site_currency_symbol_position">
                                            <?php $__currentLoopData = $all_currency_position; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($cur); ?>"
                                                        <?php if(get_static_option('site_currency_symbol_position') == $cur): ?> selected <?php endif; ?>><?php echo e(ucwords($cur)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="site_default_payment_gateway"><?php echo e(__('Default Payment Gateway')); ?></label>
                                        <select name="site_default_payment_gateway" class="form-control" >
                                            <?php
                                                $all_gateways = \App\Helpers\PaymentGatewayRenderHelper::listOfPaymentGateways();
                                            ?>
                                            <?php $__currentLoopData = $all_gateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(!empty(get_static_option($gateway.'_gateway'))): ?>
                                                    <option value="<?php echo e($gateway); ?>" <?php if(get_static_option('site_default_payment_gateway') == $gateway): ?> selected <?php endif; ?>><?php echo e(ucwords(str_replace('_',' ',$gateway))); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <?php $global_currency = get_static_option('site_global_currency');?>

                                    <?php if($global_currency != 'USD'): ?>
                                        <div class="form-group">
                                            <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_usd_exchange_rate"><?php echo e(__($global_currency.' to USD Exchange Rate')); ?></label>
                                            <input type="text" class="form-control"
                                                   name="site_<?php echo e(strtolower($global_currency)); ?>_to_usd_exchange_rate"
                                                   value="<?php echo e(get_static_option('site_'.$global_currency.'_to_usd_exchange_rate')); ?>">
                                            <span class="info-text"><?php echo e(sprintf(__('enter %s to USD exchange rate. eg: 1 %s = ? USD'),$global_currency,$global_currency)); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($global_currency != 'IDR'): ?>
                                        <div class="form-group">
                                            <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_idr_exchange_rate"><?php echo e(__($global_currency.' to IDR Exchange Rate')); ?></label>
                                            <input type="text" class="form-control"
                                                   name="site_<?php echo e(strtolower($global_currency)); ?>_to_idr_exchange_rate"
                                                   value="<?php echo e(get_static_option('site_'.$global_currency.'_to_idr_exchange_rate')); ?>">
                                            <span class="info-text"><?php echo e(sprintf(__('enter %s to USD exchange rate. eg: 1 %s = ? IDR'),$global_currency,$global_currency)); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($global_currency != 'INR' && !empty(get_static_option('paytm_gateway') || !empty(get_static_option('razorpay_gateway')))): ?>
                                        <div class="form-group">
                                            <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_inr_exchange_rate"><?php echo e(__($global_currency.' to INR Exchange Rate')); ?></label>
                                            <input type="text" class="form-control"
                                                   name="site_<?php echo e(strtolower($global_currency)); ?>_to_inr_exchange_rate"
                                                   value="<?php echo e(get_static_option('site_'.$global_currency.'_to_inr_exchange_rate')); ?>">
                                            <span class="info-text"><?php echo e(__('enter '.$global_currency.' to INR exchange rate. eg: 1'.$global_currency.' = ? INR')); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($global_currency != 'NGN' && !empty(get_static_option('paystack_gateway') )): ?>
                                        <div class="form-group">
                                            <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_ngn_exchange_rate"><?php echo e(__($global_currency.' to NGN Exchange Rate')); ?></label>
                                            <input type="text" class="form-control"
                                                   name="site_<?php echo e(strtolower($global_currency)); ?>_to_ngn_exchange_rate"
                                                   value="<?php echo e(get_static_option('site_'.$global_currency.'_to_ngn_exchange_rate')); ?>">
                                            <span class="info-text"><?php echo e(__('enter '.$global_currency.' to NGN exchange rate. eg: 1'.$global_currency.' = ? NGN')); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($global_currency != 'ZAR'): ?>
                                        <div class="form-group">
                                            <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_zar_exchange_rate"><?php echo e(__($global_currency.' to ZAR Exchange Rate')); ?></label>
                                            <input type="text" class="form-control"
                                                   name="site_<?php echo e(strtolower($global_currency)); ?>_to_zar_exchange_rate"
                                                   value="<?php echo e(get_static_option('site_'.$global_currency.'_to_zar_exchange_rate')); ?>">
                                            <span class="info-text"><?php echo e(sprintf(__('enter %s to USD exchange rate. eg: 1 %s = ? ZAR'),$global_currency,$global_currency)); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($global_currency != 'BRL'): ?>
                                        <div class="form-group">
                                            <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_brl_exchange_rate"><?php echo e(__($global_currency.' to BRL Exchange Rate')); ?></label>
                                            <input type="text" class="form-control"
                                                   name="site_<?php echo e(strtolower($global_currency)); ?>_to_brl_exchange_rate"
                                                   value="<?php echo e(get_static_option('site_'.$global_currency.'_to_brl_exchange_rate')); ?>">
                                            <span class="info-text"><?php echo e(__('enter '.$global_currency.' to BRL exchange rate. eg: 1'.$global_currency.' = ? BRL')); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($global_currency != 'MYR'): ?>
                                        <div class="form-group">
                                            <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_myr_exchange_rate"><?php echo e(__($global_currency.' to MYR Exchange Rate')); ?></label>
                                            <input type="text" class="form-control"
                                                   name="site_<?php echo e(strtolower($global_currency)); ?>_to_myr_exchange_rate"
                                                   value="<?php echo e(get_static_option('site_'.$global_currency.'_to_myr_exchange_rate')); ?>">
                                            <span class="info-text"><?php echo e(__('enter '.$global_currency.' to MYR exchange rate. eg: 1'.$global_currency.' = ? MYR')); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <div class="accordion-wrapper">
                                        <div id="accordion-payment">
                                            <div class="card">
                                                <div class="card-header" id="paypal_settings">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button"
                                                                data-toggle="collapse"
                                                                data-target="#paypal_settings_content"
                                                                aria-expanded="true">
                                                            <span class="page-title"> <?php echo e(__('Paypal Settings')); ?></span>
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="paypal_settings_content" class="collapse show"
                                                     data-parent="#accordion-payment">
                                                    <div class="card-body">
                                                        <div class="payment-notice alert alert-warning">
                                                            <p><?php echo e(__("Available Currency For Paypal is")); ?> <?php echo e(implode(',', Xgenious\Paymentgateway\Facades\XgPaymentGateway::paypal()->supported_currency_list())); ?></p>
                                                            <p><?php echo e(__('if your currency is not available in paypal, it will convert you currency value to USD value based on your currency exchange rate.')); ?></p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="paypal_gateway"><strong><?php echo e(__('Enable Paypal')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="paypal_gateway"
                                                                       <?php if(!empty(get_static_option('paypal_gateway'))): ?> checked
                                                                       <?php endif; ?> id="paypal_gateway">
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="paypal_test_mode"><strong><?php echo e(__('Enable Test Mode For Paypal')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="paypal_test_mode"
                                                                       <?php if(!empty(get_static_option('paypal_test_mode'))): ?> checked
                                                                        <?php endif; ?> >
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="site_logo"><strong><?php echo e(__('Paypal Logo')); ?></strong></label>
                                                            <div class="media-upload-btn-wrapper">
                                                                <div class="img-wrap">
                                                                    <?php
                                                                        $paypal_img = get_attachment_image_by_id(get_static_option('paypal_preview_logo'),null,true);
                                                                        $paypal_image_btn_label = __('Upload Image');
                                                                    ?>
                                                                    <?php if(!empty($paypal_img)): ?>
                                                                        <div class="attachment-preview">
                                                                            <div class="thumbnail">
                                                                                <div class="centered">
                                                                                    <img class="avatar user-thumb"
                                                                                         src="<?php echo e($paypal_img['img_url']); ?>"
                                                                                         alt="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php  $paypal_image_btn_label = __('Change Image'); ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <input type="hidden" id="paypal_preview_logo"
                                                                       name="paypal_preview_logo"
                                                                       value="<?php echo e(get_static_option('paypal_preview_logo')); ?>">
                                                                <button type="button"
                                                                        class="btn btn-info media_upload_form_btn"
                                                                        data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                                        data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                                                                        data-toggle="modal"
                                                                        data-target="#media_upload_modal">
                                                                    <?php echo e(__($paypal_image_btn_label)); ?>

                                                                </button>
                                                            </div>
                                                            <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="paypal_sandbox_client_id"><?php echo e(__('Paypal Sandbox Client ID')); ?></label>

                                                            <input type="text" name="paypal_sandbox_client_id"
                                                                   class="form-control"
                                                                   value="<?php echo e(get_static_option('paypal_sandbox_client_id')); ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="paypal_sandbox_client_secret"><?php echo e(__('Paypal Sandbox Client Secret')); ?></label>
                                                            <input type="text" name="paypal_sandbox_client_secret"
                                                                   class="form-control"
                                                                   value="<?php echo e(get_static_option('paypal_sandbox_client_secret')); ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="paypal_sandbox_app_id"><?php echo e(__('Paypal Sandbox App ID')); ?></label>
                                                            <input type="text" name="paypal_sandbox_app_id"
                                                                   class="form-control"
                                                                   value="<?php echo e(get_static_option('paypal_sandbox_app_id')); ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="paypal_live_client_id"><?php echo e(__('Paypal Live Client ID')); ?></label>
                                                            <input type="text" name="paypal_live_client_id"
                                                                   class="form-control"
                                                                   value="<?php echo e(get_static_option('paypal_live_client_id')); ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="paypal_live_client_secret"><?php echo e(__('Paypal Live Client Secret')); ?></label>
                                                            <input type="text" name="paypal_live_client_secret"
                                                                   class="form-control"
                                                                   value="<?php echo e(get_static_option('paypal_live_client_secret')); ?>">
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="paypal_live_app_id"><?php echo e(__('Paypal Live App ID')); ?></label>
                                                            <input type="text" name="paypal_live_app_id"
                                                                   class="form-control"
                                                                   value="<?php echo e(get_static_option('paypal_live_app_id')); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header" id="paytm_settings">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button"
                                                                data-toggle="collapse"
                                                                data-target="#paytm_settings_content"
                                                                aria-expanded="false">
                                                            <span class="page-title"> <?php echo e(__('Paytm Settings')); ?></span>
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="paytm_settings_content" class="collapse"
                                                     data-parent="#accordion-payment">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <div class="payment-notice alert alert-warning">
                                                                <p><?php echo e(__("Available Currency For Paytm is")); ?> <?php echo e(implode(',',\Xgenious\Paymentgateway\Facades\XgPaymentGateway::paytm()->supported_currency_list())); ?></p>
                                                                <p><?php echo e(__('if your currency is not available in paytm, it will convert you currency value to INR value based on your currency exchange rate.')); ?></p>
                                                            </div>
                                                            <label for="paytm_gateway"><strong><?php echo e(__('Enable/Disable Paytm')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="paytm_gateway"
                                                                       <?php if(!empty(get_static_option('paytm_gateway'))): ?> checked
                                                                       <?php endif; ?> id="paytm_gateway">
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="paytm_test_mode"><strong><?php echo e(__('Enable Test Mode For Paytm')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="paytm_test_mode"
                                                                       <?php if(!empty(get_static_option('paytm_test_mode'))): ?> checked
                                                                        <?php endif; ?> >
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="site_logo"><strong><?php echo e(__('Paytm Logo')); ?></strong></label>
                                                            <div class="media-upload-btn-wrapper">
                                                                <div class="img-wrap">
                                                                    <?php
                                                                        $paytm_img = get_attachment_image_by_id(get_static_option('paytm_preview_logo'),null,true);
                                                                        $paytm_image_btn_label = __('Upload Image');
                                                                    ?>
                                                                    <?php if(!empty($paytm_img)): ?>
                                                                        <div class="attachment-preview">
                                                                            <div class="thumbnail">
                                                                                <div class="centered">
                                                                                    <img class="avatar user-thumb"
                                                                                         src="<?php echo e($paytm_img['img_url']); ?>"
                                                                                         alt="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php  $paytm_image_btn_label = __('Change Image'); ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <input type="hidden" id="paytm_preview_logo"
                                                                       name="paytm_preview_logo"
                                                                       value="<?php echo e(get_static_option('paytm_preview_logo')); ?>">
                                                                <button type="button"
                                                                        class="btn btn-info media_upload_form_btn"
                                                                        data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                                        data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                                                                        data-toggle="modal"
                                                                        data-target="#media_upload_modal">
                                                                    <?php echo e(__($paytm_image_btn_label)); ?>

                                                                </button>
                                                            </div>
                                                            <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="paytm_merchant_key"><?php echo e(__('Paytm Merchant Key')); ?></label>
                                                            <input type="text" name="paytm_merchant_key" id="paytm_merchant_key" value="<?php echo e(get_static_option('paytm_merchant_key')); ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="paytm_merchant_mid"><?php echo e(__('Paytm Merchant ID')); ?></label>
                                                            <input type="text" name="paytm_merchant_mid" id="paytm_merchant_mid"  value="<?php echo e(get_static_option('paytm_merchant_mid')); ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="paytm_merchant_website"><?php echo e(__('Paytm Merchant Website')); ?></label>
                                                            <input type="text" name="paytm_merchant_website" id="paytm_merchant_website"  value="<?php echo e(get_static_option('paytm_merchant_website')); ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="paytm_channel"><?php echo e(__('Paytm channel')); ?></label>
                                                            <input type="text" name="paytm_channel" value="<?php echo e(get_static_option('paytm_channel')); ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="paytm_industry_type"><?php echo e(__('Paytm Industry Type')); ?></label>
                                                            <input type="text" name="paytm_industry_type" value="<?php echo e(get_static_option('paytm_industry_type')); ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="stripe_settings">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#stripe_settings_content" aria-expanded="false" >
                                                            <span class="page-title"> <?php echo e(__('Stripe Settings')); ?></span>
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="stripe_settings_content" class="collapse"  data-parent="#accordion-payment">
                                                    <div class="card-body">
                                                        <div class="payment-notice alert alert-warning">
                                                            <p><?php echo e(__("Stripe supported currency ")); ?> <?php echo e(implode(',',\Xgenious\Paymentgateway\Facades\XgPaymentGateway::stripe()->supported_currency_list())); ?></p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="stripe_gateway"><strong><?php echo e(__('Enable/Disable Stripe')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="stripe_gateway"  <?php if(!empty(get_static_option('stripe_gateway'))): ?> checked <?php endif; ?> id="stripe_gateway">
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="stripe_logo"><strong><?php echo e(__('Stripe Logo')); ?></strong></label>
                                                            <div class="media-upload-btn-wrapper">
                                                                <div class="img-wrap">
                                                                    <?php
                                                                        $stripe_img = get_attachment_image_by_id(get_static_option('stripe_preview_logo'),null,true);
                                                                        $stripe_image_btn_label = __('Upload Image');
                                                                    ?>
                                                                    <?php if(!empty($stripe_img)): ?>
                                                                        <div class="attachment-preview">
                                                                            <div class="thumbnail">
                                                                                <div class="centered">
                                                                                    <img class="avatar user-thumb" src="<?php echo e($stripe_img['img_url']); ?>" alt="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php  $stripe_image_btn_label = __('Change Image'); ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <input type="hidden" id="stripe_preview_logo" name="stripe_preview_logo" value="<?php echo e(get_static_option('stripe_preview_logo')); ?>">
                                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                                    <?php echo e(__($stripe_image_btn_label)); ?>

                                                                </button>
                                                            </div>
                                                            <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="stripe_public_key"><?php echo e(__('Stripe Public Key')); ?></label>
                                                            <input type="text" name="stripe_public_key" id="stripe_public_key" value="<?php echo e(get_static_option('stripe_public_key')); ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="stripe_secret_key"><?php echo e(__('Stripe Secret')); ?></label>
                                                            <input type="text" name="stripe_secret_key" id="stripe_secret_key"  value="<?php echo e(get_static_option('stripe_secret_key')); ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="razorpay_settings">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#razorpay_settings_content" aria-expanded="false" >
                                                            <span class="page-title"> <?php echo e(__('Razorpay Settings')); ?></span>
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="razorpay_settings_content" class="collapse"  data-parent="#accordion-payment">
                                                    <div class="card-body">
                                                        <div class="payment-notice alert alert-warning">
                                                            <p><?php echo e(__("Available Currency For Razorpay is, ['INR']")); ?></p>
                                                            <p><?php echo e(__('if your currency is not available in Razorpay, it will convert you currency value to INR value based on your currency exchange rate.')); ?></p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="razorpay_gateway"><strong><?php echo e(__('Enable/Disable Razorpay')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="razorpay_gateway"  <?php if(!empty(get_static_option('razorpay_gateway'))): ?> checked <?php endif; ?> id="razorpay_gateway">
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="razorpay_logo"><strong><?php echo e(__('Razorpay Logo')); ?></strong></label>
                                                            <div class="media-upload-btn-wrapper">
                                                                <div class="img-wrap">
                                                                    <?php
                                                                        $razorpay_img = get_attachment_image_by_id(get_static_option('razorpay_preview_logo'),null,true);
                                                                        $razorpay_image_btn_label = __('Upload Image');
                                                                    ?>
                                                                    <?php if(!empty($razorpay_img)): ?>
                                                                        <div class="attachment-preview">
                                                                            <div class="thumbnail">
                                                                                <div class="centered">
                                                                                    <img class="avatar user-thumb" src="<?php echo e($razorpay_img['img_url']); ?>" alt="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php  $razorpay_image_btn_label = __('Change Image'); ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <input type="hidden" id="razorpay_preview_logo" name="razorpay_preview_logo" value="<?php echo e(get_static_option('razorpay_preview_logo')); ?>">
                                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                                    <?php echo e(__($razorpay_image_btn_label)); ?>

                                                                </button>
                                                            </div>
                                                            <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="razorpay_api_key"><?php echo e(__('Razorpay Key')); ?></label>
                                                            <input type="text" name="razorpay_api_key" id="razorpay_api_key" value="<?php echo e(get_static_option('razorpay_api_key')); ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="razorpay_api_secret"><?php echo e(__('Razorpay Secret')); ?></label>
                                                            <input type="text" name="razorpay_api_secret" id="razorpay_api_secret"  value="<?php echo e(get_static_option('razorpay_api_secret')); ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="paystack_settings">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#paystack_settings_content" aria-expanded="false" >
                                                            <span class="page-title"> <?php echo e(__('PayStack Settings')); ?></span>
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="paystack_settings_content" class="collapse"  data-parent="#accordion-payment">
                                                    <div class="card-body">
                                                        <div class="payment-notice alert alert-warning">
                                                            <p><?php echo e(__("Available Currency For Paystack is")); ?> <?php echo e(implode(',',\Xgenious\Paymentgateway\Facades\XgPaymentGateway::paystack()->supported_currency_list())); ?></p>
                                                            <p><?php echo e(__('if your currency is not available in Paystack, it will convert you currency value to NGN value based on your currency exchange rate.')); ?></p>
                                                        </div>
                                                        <p class="margin-bottom-30 margin-top-20 info-paragraph">
                                                            <?php echo e(__('Don\'t forget to put below url to "Settings > API Key & Webhook > Callback URL" in your paystack admin panel')); ?>

                                                            <input type="text" class="info-url" value="<?php echo e(route('frontend.paystack.ipn')); ?>">
                                                        </p>
                                                        <div class="form-group">
                                                            <label for="paystack_gateway"><strong><?php echo e(__('Enable/Disable PayStack')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="paystack_gateway"  <?php if(!empty(get_static_option('paystack_gateway'))): ?> checked <?php endif; ?> id="paystack_gateway">
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="paystack_preview_logo"><strong><?php echo e(__('PayStack Logo')); ?></strong></label>
                                                            <div class="media-upload-btn-wrapper">
                                                                <div class="img-wrap">
                                                                    <?php
                                                                        $paystack_img = get_attachment_image_by_id(get_static_option('paystack_preview_logo'),null,true);
                                                                        $paystack_image_btn_label = __('Upload Image');
                                                                    ?>
                                                                    <?php if(!empty($paystack_img)): ?>
                                                                        <div class="attachment-preview">
                                                                            <div class="thumbnail">
                                                                                <div class="centered">
                                                                                    <img class="avatar user-thumb" src="<?php echo e($paystack_img['img_url']); ?>" alt="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php  $paystack_image_btn_label = __('Change Image'); ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <input type="hidden" id="paystack_preview_logo" name="paystack_preview_logo" value="<?php echo e(get_static_option('paystack_preview_logo')); ?>">
                                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                                    <?php echo e(__($paystack_image_btn_label)); ?>

                                                                </button>
                                                            </div>
                                                            <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="paystack_public_key"><?php echo e(__('PayStack Public Key')); ?></label>
                                                            <input type="text" name="paystack_public_key" id="paystack_public_key" value="<?php echo e(get_static_option('paystack_public_key')); ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="paystack_secret_key"><?php echo e(__('PayStack Secret Key')); ?></label>
                                                            <input type="text" name="paystack_secret_key" id="paystack_secret_key"  value="<?php echo e(get_static_option('paystack_secret_key')); ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="paystack_merchant_email"><?php echo e(__('PayStack Merchant Email')); ?></label>
                                                            <input type="text" name="paystack_merchant_email" id="paystack_merchant_email"  value="<?php echo e(get_static_option('paystack_merchant_email')); ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header" id="mollie_settings">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#mollie_settings_content" aria-expanded="false" >
                                                            <span class="page-title"> <?php echo e(__('Mollie Settings')); ?></span>
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="mollie_settings_content" class="collapse"  data-parent="#accordion-payment">
                                                    <div class="card-body">
                                                        <div class="payment-notice alert alert-warning">
                                                            <p><?php echo e(__("Available Currency For Mollie is")); ?> <?php echo e(implode(',',\Xgenious\Paymentgateway\Facades\XgPaymentGateway::mollie()->supported_currency_list())); ?></p>
                                                            <p><?php echo e(__('if your currency is not available in mollie, it will convert you currency value to USD value based on your currency exchange rate.')); ?></p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="mollie_gateway"><strong><?php echo e(__('Enable/Disable Mollie')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="mollie_gateway"  <?php if(!empty(get_static_option('mollie_gateway'))): ?> checked <?php endif; ?> id="mollie_gateway">
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="mollie_preview_logo"><strong><?php echo e(__('Mollie Logo')); ?></strong></label>
                                                            <div class="media-upload-btn-wrapper">
                                                                <div class="img-wrap">
                                                                    <?php
                                                                        $mollie_img = get_attachment_image_by_id(get_static_option('mollie_preview_logo'),null,true);
                                                                        $mollie_image_btn_label = __('Upload Image');
                                                                    ?>
                                                                    <?php if(!empty($mollie_img)): ?>
                                                                        <div class="attachment-preview">
                                                                            <div class="thumbnail">
                                                                                <div class="centered">
                                                                                    <img class="avatar user-thumb" src="<?php echo e($mollie_img['img_url']); ?>" alt="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php  $mollie_image_btn_label = __('Change Image'); ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <input type="hidden" id="mollie_preview_logo" name="mollie_preview_logo" value="<?php echo e(get_static_option('mollie_preview_logo')); ?>">
                                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                                    <?php echo e(__($mollie_image_btn_label)); ?>

                                                                </button>
                                                            </div>
                                                            <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="mollie_public_key"><?php echo e(__('Mollie Public Key')); ?></label>
                                                            <input type="text" name="mollie_public_key" id="mollie_public_key" value="<?php echo e(get_static_option('mollie_public_key')); ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="card">
                                                <div class="card-header" id="flluterwave_settings">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#flutterwave_settings_content" aria-expanded="false" >
                                                            <span class="page-title"> <?php echo e(__('Flutterwave Settings')); ?></span>
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="flutterwave_settings_content" class="collapse"  data-parent="#accordion-payment">
                                                    <div class="card-body">
                                                        <div class="payment-notice alert alert-warning">
                                                            <p><?php echo e(__("Available Currency For Flutterwave is")); ?> <?php echo e(implode(',',\Xgenious\Paymentgateway\Facades\XgPaymentGateway::flutterwave()->supported_currency_list())); ?></p>
                                                            <p><?php echo e(__('if your currency is not available in flutterwave, it will convert you currency value to USD value based on your currency exchange rate.')); ?></p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="flutterwave_gateway"><strong><?php echo e(__('Enable/Disable Flutterwave')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="flutterwave_gateway"  <?php if(!empty(get_static_option('flutterwave_gateway'))): ?> checked <?php endif; ?> id="flutterwave_gateway">
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="flutterwave_test_mode"><strong><?php echo e(__('Enable Test Mode Flutterwave')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="flutterwave_test_mode" <?php if(!empty(get_static_option('flutterwave_test_mode'))): ?> checked <?php endif; ?>>
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="flutterwave_preview_logo"><strong><?php echo e(__('Flutterwave Logo')); ?></strong></label>
                                                            <div class="media-upload-btn-wrapper">
                                                                <div class="img-wrap">
                                                                    <?php
                                                                        $mollie_img = get_attachment_image_by_id(get_static_option('flutterwave_preview_logo'),null,true);
                                                                        $mollie_image_btn_label = __('Upload Image');
                                                                    ?>
                                                                    <?php if(!empty($mollie_img)): ?>
                                                                        <div class="attachment-preview">
                                                                            <div class="thumbnail">
                                                                                <div class="centered">
                                                                                    <img class="avatar user-thumb" src="<?php echo e($mollie_img['img_url']); ?>" alt="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php  $mollie_image_btn_label = __('Change Image'); ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <input type="hidden" id="flutterwave_preview_logo" name="flutterwave_preview_logo" value="<?php echo e(get_static_option('flutterwave_preview_logo')); ?>">
                                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                                    <?php echo e(__($mollie_image_btn_label)); ?>

                                                                </button>
                                                            </div>
                                                            <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="flw_public_key"><?php echo e(__('Flutterwave Public Key')); ?></label>
                                                            <input type="text" name="flw_public_key" id="flw_public_key" value="<?php echo e(get_static_option('flw_public_key')); ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="flw_secret_key"><?php echo e(__('Flutterwave Secret Key')); ?></label>
                                                            <input type="text" name="flw_secret_key" id="flw_secret_key" value="<?php echo e(get_static_option('flw_secret_key')); ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="flw_secret_hash"><?php echo e(__('Flutterwave Secret Hash')); ?></label>
                                                            <input type="text" name="flw_secret_hash" id="flw_secret_hash" value="<?php echo e(get_static_option('flw_secret_hash')); ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header" id="midtrans_settings">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#midtrans_settings_content" aria-expanded="false" >
                                                            <span class="page-title"> <?php echo e(__('MIdtranse Settings')); ?></span>
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="midtrans_settings_content" class="collapse"  data-parent="#accordion-payment">
                                                    <div class="card-body">

                                                        <div class="form-group">
                                                            <label for="flutterwave_gateway"><strong><?php echo e(__('Enable/Disable Midtrans')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="midtrans_gateway"  <?php if(!empty(get_static_option('midtrans_gateway'))): ?> checked <?php endif; ?> id="flutterwave_gateway">
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="midtrans_test_mode"><strong><?php echo e(__('Enable Test Mode Midtranse')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="midtrans_test_mode" <?php if(!empty(get_static_option('midtrans_test_mode'))): ?> checked <?php endif; ?>>
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="midtrans_preview_logo"><strong><?php echo e(__('Midtranse Logo')); ?></strong></label>
                                                            <div class="media-upload-btn-wrapper">
                                                                <div class="img-wrap">
                                                                    <?php
                                                                        $midtrans_img = get_attachment_image_by_id(get_static_option('midtrans_preview_logo'),null,true);
                                                                        $midtrans_image_btn_label = __('Upload Image');
                                                                    ?>
                                                                    <?php if(!empty($midtrans_img)): ?>
                                                                        <div class="attachment-preview">
                                                                            <div class="thumbnail">
                                                                                <div class="centered">
                                                                                    <img class="avatar user-thumb" src="<?php echo e($midtrans_img['img_url']); ?>" alt="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php  $midtrans_image_btn_label = __('Change Image'); ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <input type="hidden" id="midtrans_preview_logo" name="midtrans_preview_logo" value="<?php echo e(get_static_option('midtrans_preview_logo')); ?>">
                                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                                    <?php echo e(__($mollie_image_btn_label)); ?>

                                                                </button>
                                                            </div>
                                                            <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="midtrans_merchant_id"><?php echo e(__('Midtranse Merchant ID')); ?></label>
                                                            <input type="text" name="midtrans_merchant_id" id="midtrans_merchant_id" value="<?php echo e(get_static_option('midtrans_merchant_id')); ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="midtrans_server_key"><?php echo e(__('Midtranse Server Key')); ?></label>
                                                            <input type="text" name="midtrans_server_key" id="midtrans_server_key" value="<?php echo e(get_static_option('midtrans_server_key')); ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="midtrans_client_key"><?php echo e(__('Midtranse Client Key')); ?></label>
                                                            <input type="text" name="midtrans_client_key" id="midtrans_client_key" value="<?php echo e(get_static_option('midtrans_client_key')); ?>" class="form-control">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="payfast_settings">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#payfast_settings_content" aria-expanded="false" >
                                                            <span class="page-title"> <?php echo e(__('Payfast Settings')); ?></span>
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="payfast_settings_content" class="collapse"  data-parent="#accordion-payment">
                                                    <div class="card-body">

                                                        <div class="form-group">
                                                            <label for="payfast_gateway"><strong><?php echo e(__('Enable/Disable Payfast')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="payfast_gateway"  <?php if(!empty(get_static_option('payfast_gateway'))): ?> checked <?php endif; ?> id="payfast_gateway">
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="payfast_test_mode"><strong><?php echo e(__('Enable Test Mode Payfast')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="payfast_test_mode" <?php if(!empty(get_static_option('payfast_test_mode'))): ?> checked <?php endif; ?>>
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="midtrans_preview_logo"><strong><?php echo e(__('Payfast Logo')); ?></strong></label>
                                                            <div class="media-upload-btn-wrapper">
                                                                <div class="img-wrap">
                                                                    <?php
                                                                        $payfast_img = get_attachment_image_by_id(get_static_option('payfast_preview_logo'),null,true);
                                                                        $payfast_image_btn_label = __('Upload Image');
                                                                    ?>
                                                                    <?php if(!empty($midtrans_img)): ?>
                                                                        <div class="attachment-preview">
                                                                            <div class="thumbnail">
                                                                                <div class="centered">
                                                                                    <img class="avatar user-thumb" src="<?php echo e($payfast_img['img_url']); ?>" alt="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php  $payfast_image_btn_label = __('Change Image'); ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <input type="hidden" id="payfast_preview_logo" name="payfast_preview_logo" value="<?php echo e(get_static_option('payfast_preview_logo')); ?>">
                                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                                    <?php echo e(__($mollie_image_btn_label)); ?>

                                                                </button>
                                                            </div>
                                                            <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="midtrans_merchant_id"><?php echo e(__('Payfast Merchant ID')); ?></label>
                                                            <input type="text" name="payfast_merchant_id" id="payfast_merchant_id" value="<?php echo e(get_static_option('payfast_merchant_id')); ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="midtrans_server_key"><?php echo e(__('Payfast Merchant Key')); ?></label>
                                                            <input type="text" name="payfast_merchant_key" id="payfast_merchant_key" value="<?php echo e(get_static_option('payfast_merchant_key')); ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="midtrans_client_key"><?php echo e(__('Payfast Passphrase')); ?></label>
                                                            <input type="text" name="payfast_passphrase" id="payfast_passphrase" value="<?php echo e(get_static_option('payfast_passphrase')); ?>" class="form-control">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="midtrans_environment"><?php echo e(__('Payfast ITN URL')); ?></label>
                                                            <input type="text" name="payfast_itn_url" id="payfast_itn_url" value="<?php echo e(get_static_option('payfast_itn_url')); ?>" class="form-control">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header" id="cashfree_settings">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#cashfree_settings_content" aria-expanded="false" >
                                                            <span class="page-title"> <?php echo e(__('Cashfree Settings')); ?></span>
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="cashfree_settings_content" class="collapse"  data-parent="#accordion-payment">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label for="cashfree_gateway"><strong><?php echo e(__('Enable/Disable Cashfree')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="cashfree_gateway"  <?php if(!empty(get_static_option('cashfree_gateway'))): ?> checked <?php endif; ?> id="cashfree_gateway">
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="cashfree_test_mode"><strong><?php echo e(__('Enable Test Mode Cashfree')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="cashfree_test_mode" <?php if(!empty(get_static_option('cashfree_test_mode'))): ?> checked <?php endif; ?>>
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="midtrans_preview_logo"><strong><?php echo e(__('Cashfree Logo')); ?></strong></label>
                                                            <div class="media-upload-btn-wrapper">
                                                                <div class="img-wrap">
                                                                    <?php
                                                                        $cashfree_img = get_attachment_image_by_id(get_static_option('cashfree_preview_logo'),null,true);
                                                                        $cashfree_image_btn_label = __('Upload Image');
                                                                    ?>
                                                                    <?php if(!empty($midtrans_img)): ?>
                                                                        <div class="attachment-preview">
                                                                            <div class="thumbnail">
                                                                                <div class="centered">
                                                                                    <img class="avatar user-thumb" src="<?php echo e($cashfree_img['img_url']); ?>" alt="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php  $cashfree_image_btn_label = __('Change Image'); ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <input type="hidden" id="cashfree_preview_logo" name="cashfree_preview_logo" value="<?php echo e(get_static_option('cashfree_preview_logo')); ?>">
                                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                                    <?php echo e(__($mollie_image_btn_label)); ?>

                                                                </button>
                                                            </div>
                                                            <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="cashfree_app_id"><?php echo e(__('Cashfree App ID')); ?></label>
                                                            <input type="text" name="cashfree_app_id" id="cashfree_app_id" value="<?php echo e(get_static_option('cashfree_app_id')); ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="cashfree_secret_key"><?php echo e(__('Cashfree Secret Key')); ?></label>
                                                            <input type="text" name="cashfree_secret_key" id="cashfree_secret_key" value="<?php echo e(get_static_option('cashfree_secret_key')); ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header" id="instamojo_settings">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#instamojo_settings_content" aria-expanded="false" >
                                                            <span class="page-title"> <?php echo e(__('Instamojo Settings')); ?></span>
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="instamojo_settings_content" class="collapse"  data-parent="#accordion-payment">
                                                    <div class="card-body">

                                                        <div class="form-group">
                                                            <label for="instamojo_gateway"><strong><?php echo e(__('Enable/Disable Instamojo')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="instamojo_gateway"  <?php if(!empty(get_static_option('instamojo_gateway'))): ?> checked <?php endif; ?> id="instamojo_gateway">
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="instamojo_test_mode"><strong><?php echo e(__('Enable Test Mode Instamojo')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="instamojo_test_mode" <?php if(!empty(get_static_option('instamojo_test_mode'))): ?> checked <?php endif; ?>>
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="midtrans_preview_logo"><strong><?php echo e(__('Instamojo Logo')); ?></strong></label>
                                                            <div class="media-upload-btn-wrapper">
                                                                <div class="img-wrap">
                                                                    <?php
                                                                        $instamojo_img = get_attachment_image_by_id(get_static_option('instamojo_preview_logo'),null,true);
                                                                        $instamojo_image_btn_label = __('Upload Image');
                                                                    ?>
                                                                    <?php if(!empty($midtrans_img)): ?>
                                                                        <div class="attachment-preview">
                                                                            <div class="thumbnail">
                                                                                <div class="centered">
                                                                                    <img class="avatar user-thumb" src="<?php echo e($instamojo_img['img_url']); ?>" alt="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php  $instamojo_image_btn_label = __('Change Image'); ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <input type="hidden" id="instamojo_preview_logo" name="instamojo_preview_logo" value="<?php echo e(get_static_option('instamojo_preview_logo')); ?>">
                                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                                    <?php echo e(__($mollie_image_btn_label)); ?>

                                                                </button>
                                                            </div>
                                                            <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="instamojo_client_id"><?php echo e(__('Instamojo Client ID')); ?></label>
                                                            <input type="text" name="instamojo_client_id" id="instamojo_client_id" value="<?php echo e(get_static_option('instamojo_client_id')); ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="instamojo_client_secret"><?php echo e(__('Instamojo Client Secret')); ?></label>
                                                            <input type="text" name="instamojo_client_secret" id="instamojo_client_secret" value="<?php echo e(get_static_option('instamojo_client_secret')); ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="instamojo_username"><?php echo e(__('Instamojo Username')); ?></label>
                                                            <input type="text" name="instamojo_username" id="instamojo_username" value="<?php echo e(get_static_option('instamojo_username')); ?>" class="form-control">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="instamojo_password"><?php echo e(__('Instamojo Password')); ?></label>
                                                            <input type="text" name="instamojo_password" id="instamojo_password" value="<?php echo e(get_static_option('instamojo_password')); ?>" class="form-control">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header" id="marcado_pago_settings">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#marcado_pago_settings_content" aria-expanded="false" >
                                                            <span class="page-title"> <?php echo e(__('Mercado Pago Settings')); ?></span>
                                                        </button>
                                                    </h5>
                                                </div>

                                                <div id="marcado_pago_settings_content" class="collapse"  data-parent="#accordion-payment">
                                                    <div class="card-body">

                                                        <div class="form-group">
                                                            <label for="marcadopago_gateway"><strong><?php echo e(__('Enable/Disable Marcado Pago')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="marcadopago_gateway"  <?php if(!empty(get_static_option('marcadopago_gateway'))): ?> checked <?php endif; ?> id="marcadopago_gateway">
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="marcadopago_test_mode"><strong><?php echo e(__('Enable Test Mode Marcado Pago')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="marcadopago_test_mode" <?php if(!empty(get_static_option('marcadopago_test_mode'))): ?> checked <?php endif; ?>>
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="marcadopago_preview_logo"><strong><?php echo e(__('Mercado Pago Logo')); ?></strong></label>
                                                            <div class="media-upload-btn-wrapper">
                                                                <div class="img-wrap">
                                                                    <?php
                                                                        $marcadopago_img = get_attachment_image_by_id(get_static_option('marcadopago_preview_logo'),null,true);
                                                                        $marcadopago_image_btn_label = __('Upload Image');
                                                                    ?>
                                                                    <?php if(!empty($midtrans_img)): ?>
                                                                        <div class="attachment-preview">
                                                                            <div class="thumbnail">
                                                                                <div class="centered">
                                                                                    <img class="avatar user-thumb" src="<?php echo e($marcadopago_img['img_url']); ?>" alt="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php  $marcadopago_image_btn_label = __('Change Image'); ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <input type="hidden" id="marcadopago_preview_logo" name="marcadopago_preview_logo" value="<?php echo e(get_static_option('marcadopago_preview_logo')); ?>">
                                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                                    <?php echo e(__($mollie_image_btn_label)); ?>

                                                                </button>
                                                            </div>
                                                            <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="marcado_pago_client_id"><?php echo e(__('Mercado Pago Client ID')); ?></label>
                                                            <input type="text" name="marcado_pago_client_id" id="marcado_pago_client_id" value="<?php echo e(get_static_option('marcado_pago_client_id')); ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="marcado_pago_client_secret">
                                                                <?php if(!empty(get_static_option('marcadopago_test_mode'))): ?>
                                                                    <?php echo e(__('Mercado Pago Client Secret')); ?>

                                                                <?php else: ?>
                                                                    <?php echo e(__('Mercado Pago Access Token')); ?>

                                                                <?php endif; ?>

                                                            </label>
                                                            <input type="text" name="marcado_pago_client_secret" id="marcado_pago_client_secret" value="<?php echo e(get_static_option('marcado_pago_client_secret')); ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            

                                            <div class="card">
                                                <div class="card-header" id="squareup_pago_settings">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#squareup_pago_settings_content" aria-expanded="false" >
                                                            <span class="page-title"> <?php echo e(__('Squareup Settings')); ?></span>
                                                        </button>
                                                    </h5>
                                                </div>

                                                <div id="squareup_pago_settings_content" class="collapse"  data-parent="#accordion-payment">
                                                    <div class="card-body">

                                                        <div class="form-group">
                                                            <label for="squareup_gateway"><strong><?php echo e(__('Enable/Disable Squareup')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="squareup_gateway"  <?php if(!empty(get_static_option('squareup_gateway'))): ?> checked <?php endif; ?> id="squareup_gateway">
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="squareup_test_mode"><strong><?php echo e(__('Enable Test Mode Squareup')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="squareup_test_mode" <?php if(!empty(get_static_option('squareup_test_mode'))): ?> checked <?php endif; ?>>
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="squareup_preview_logo"><strong><?php echo e(__('Squareup Logo')); ?></strong></label>
                                                            <div class="media-upload-btn-wrapper">
                                                                <div class="img-wrap">
                                                                    <?php
                                                                        $marcadopago_img = get_attachment_image_by_id(get_static_option('squareup_preview_logo'),null,true);
                                                                        $marcadopago_image_btn_label = __('Upload Image');
                                                                    ?>
                                                                    <?php if(!empty($midtrans_img)): ?>
                                                                        <div class="attachment-preview">
                                                                            <div class="thumbnail">
                                                                                <div class="centered">
                                                                                    <img class="avatar user-thumb" src="<?php echo e($marcadopago_img['img_url']); ?>" alt="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php  $marcadopago_image_btn_label = __('Change Image'); ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <input type="hidden" id="squareup_preview_logo" name="squareup_preview_logo" value="<?php echo e(get_static_option('squareup_preview_logo')); ?>">
                                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                                    <?php echo e(__($mollie_image_btn_label)); ?>

                                                                </button>
                                                            </div>
                                                            <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="squareup_access_token"><?php echo e(__('Squareup Access Token')); ?></label>
                                                            <input type="text" name="squareup_access_token"  value="<?php echo e(get_static_option('squareup_access_token')); ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="squareup_location_id"><?php echo e(__('Squareup Location ID')); ?></label>
                                                            <input type="text" name="squareup_location_id" value="<?php echo e(get_static_option('squareup_location_id')); ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="squareup_application_id"><?php echo e(__('Squareup Application ID')); ?></label>
                                                            <input type="text" name="squareup_application_id" value="<?php echo e(get_static_option('squareup_application_id')); ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            

                                            
                                            <div class="card">
                                                <div class="card-header" id="cinetpay_pago_settings">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#cinetpay_settings_content" aria-expanded="false" >
                                                            <span class="page-title"> <?php echo e(__('Cinetpay Settings')); ?></span>
                                                        </button>
                                                    </h5>
                                                </div>

                                                <div id="cinetpay_settings_content" class="collapse"  data-parent="#accordion-payment">
                                                    <div class="card-body">

                                                        <div class="form-group">
                                                            <label for="Cinetpay_gateway"><strong><?php echo e(__('Enable/Disable Cinetpay')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="cinetpay_gateway"  <?php if(!empty(get_static_option('cinetpay_gateway'))): ?> checked <?php endif; ?> >
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="cinetpay_test_mode"><strong><?php echo e(__('Enable Test Mode Cinetpay')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="cinetpay_test_mode" <?php if(!empty(get_static_option('cinetpay_test_mode'))): ?> checked <?php endif; ?>>
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="Cinetpay_preview_logo"><strong><?php echo e(__('Cinetpay Logo')); ?></strong></label>
                                                            <div class="media-upload-btn-wrapper">
                                                                <div class="img-wrap">
                                                                    <?php
                                                                        $marcadopago_img = get_attachment_image_by_id(get_static_option('cinetpay_preview_logo'),null,true);
                                                                        $marcadopago_image_btn_label = __('Upload Image');
                                                                    ?>
                                                                    <?php if(!empty($midtrans_img)): ?>
                                                                        <div class="attachment-preview">
                                                                            <div class="thumbnail">
                                                                                <div class="centered">
                                                                                    <img class="avatar user-thumb" src="<?php echo e($marcadopago_img['img_url']); ?>" alt="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php  $marcadopago_image_btn_label = __('Change Image'); ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <input type="hidden" name="cinetpay_preview_logo" value="<?php echo e(get_static_option('cinetpay_preview_logo')); ?>">
                                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                                    <?php echo e(__($mollie_image_btn_label)); ?>

                                                                </button>
                                                            </div>
                                                            <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="cinetpay_app_key"><?php echo e(__('Cinetpay App Key')); ?></label>
                                                            <input type="text" name="cinetpay_app_key"  value="<?php echo e(get_static_option('cinetpay_app_key')); ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="cinetpay_site_id"><?php echo e(__('Cinetpay Site ID')); ?></label>
                                                            <input type="text" name="cinetpay_site_id" value="<?php echo e(get_static_option('cinetpay_site_id')); ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            

                                            
                                            <div class="card">
                                                <div class="card-header" id="paytabs_pago_settings">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#paytabs_settings_content" aria-expanded="false" >
                                                            <span class="page-title"> <?php echo e(__('Paytabs Settings')); ?></span>
                                                        </button>
                                                    </h5>
                                                </div>

                                                <div id="paytabs_settings_content" class="collapse"  data-parent="#accordion-payment">
                                                    <div class="card-body">

                                                        <div class="form-group">
                                                            <label for="paytabs_gateway"><strong><?php echo e(__('Enable/Disable Paytabs')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="paytabs_gateway"  <?php if(!empty(get_static_option('paytabs_gateway'))): ?> checked <?php endif; ?> >
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="paytabs_test_mode"><strong><?php echo e(__('Enable Test Mode Paytabs')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="paytabs_test_mode" <?php if(!empty(get_static_option('paytabs_test_mode'))): ?> checked <?php endif; ?>>
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="paytabs_preview_logo"><strong><?php echo e(__('Paytabs Logo')); ?></strong></label>
                                                            <div class="media-upload-btn-wrapper">
                                                                <div class="img-wrap">
                                                                    <?php
                                                                        $marcadopago_img = get_attachment_image_by_id(get_static_option('paytabs_preview_logo'),null,true);
                                                                        $marcadopago_image_btn_label = __('Upload Image');
                                                                    ?>
                                                                    <?php if(!empty($midtrans_img)): ?>
                                                                        <div class="attachment-preview">
                                                                            <div class="thumbnail">
                                                                                <div class="centered">
                                                                                    <img class="avatar user-thumb" src="<?php echo e($marcadopago_img['img_url']); ?>" alt="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php  $marcadopago_image_btn_label = __('Change Image'); ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <input type="hidden" name="paytabs_preview_logo" value="<?php echo e(get_static_option('paytabs_preview_logo')); ?>">
                                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                                    <?php echo e(__($mollie_image_btn_label)); ?>

                                                                </button>
                                                            </div>
                                                            <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="paytabs_server_key"><?php echo e(__('Paytabs App Key')); ?></label>
                                                            <input type="text" name="paytabs_server_key"  value="<?php echo e(get_static_option('paytabs_server_key')); ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="paytabs_profile_id"><?php echo e(__('Paytabs Profile ID')); ?></label>
                                                            <input type="text" name="paytabs_profile_id" value="<?php echo e(get_static_option('paytabs_profile_id')); ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="paytabs_profile_id"><?php echo e(__('region Profile ID')); ?></label>
                                                            <?php
                                                                $paytabs_region = ['GLOBAL','ARE','EGY','SAU','OMN','JOR'];
                                                            ?>
                                                            <select name="paytabs_region" class="form-control">
                                                                <?php $__currentLoopData = $paytabs_region; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option @checked($reg === get_static_option('paytabs_region')) value="<?php echo e($reg); ?>"><?php echo e($reg); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            


                                            
                                            <div class="card">
                                                <div class="card-header" id="billplz_pago_settings">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#billplz_settings_content" aria-expanded="false" >
                                                            <span class="page-title"> <?php echo e(__('BillPlz Settings')); ?></span>
                                                        </button>
                                                    </h5>
                                                </div>

                                                <div id="billplz_settings_content" class="collapse"  data-parent="#accordion-payment">
                                                    <div class="card-body">

                                                        <div class="form-group">
                                                            <label for="billplz_gateway"><strong><?php echo e(__('Enable/Disable BillPlz')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="billplz_gateway"  <?php if(!empty(get_static_option('billplz_gateway'))): ?> checked <?php endif; ?> >
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="billplz_test_mode"><strong><?php echo e(__('Enable Test Mode BillPlz')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="billplz_test_mode" <?php if(!empty(get_static_option('billplz_test_mode'))): ?> checked <?php endif; ?>>
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="billplz_preview_logo"><strong><?php echo e(__('BillPlz Logo')); ?></strong></label>
                                                            <div class="media-upload-btn-wrapper">
                                                                <div class="img-wrap">
                                                                    <?php
                                                                        $marcadopago_img = get_attachment_image_by_id(get_static_option('billplz_preview_logo'),null,true);
                                                                        $marcadopago_image_btn_label = __('Upload Image');
                                                                    ?>
                                                                    <?php if(!empty($midtrans_img)): ?>
                                                                        <div class="attachment-preview">
                                                                            <div class="thumbnail">
                                                                                <div class="centered">
                                                                                    <img class="avatar user-thumb" src="<?php echo e($marcadopago_img['img_url']); ?>" alt="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php  $marcadopago_image_btn_label = __('Change Image'); ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <input type="hidden" name="billplz_preview_logo" value="<?php echo e(get_static_option('billplz_preview_logo')); ?>">
                                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                                    <?php echo e(__($mollie_image_btn_label)); ?>

                                                                </button>
                                                            </div>
                                                            <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="billplz_key"><?php echo e(__('BillPlz Key')); ?></label>
                                                            <input type="text" name="billplz_key"  value="<?php echo e(get_static_option('billplz_key')); ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="billplz_xsignature"><?php echo e(__('BillPlz xSignature')); ?></label>
                                                            <input type="text" name="billplz_xsignature" value="<?php echo e(get_static_option('billplz_xsignature')); ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="billplz_collection_name"><?php echo e(__('BillPlz Collection Name')); ?></label>
                                                            <input type="text" name="billplz_collection_name" value="<?php echo e(get_static_option('billplz_collection_name')); ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            

                                            
                                            <div class="card">
                                                <div class="card-header" id="zitopay_pago_settings">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#zitopay_settings_content" aria-expanded="false" >
                                                            <span class="page-title"> <?php echo e(__('Zitopay Settings')); ?></span>
                                                        </button>
                                                    </h5>
                                                </div>

                                                <div id="zitopay_settings_content" class="collapse"  data-parent="#accordion-payment">
                                                    <div class="card-body">

                                                        <div class="form-group">
                                                            <label for="zitopay_gateway"><strong><?php echo e(__('Enable/Disable Zitopay')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="zitopay_gateway"  <?php if(!empty(get_static_option('zitopay_gateway'))): ?> checked <?php endif; ?> >
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="zitopay_test_mode"><strong><?php echo e(__('Enable Test Mode Zitopay')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="zitopay_test_mode" <?php if(!empty(get_static_option('zitopay_test_mode'))): ?> checked <?php endif; ?>>
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="zitopay_preview_logo"><strong><?php echo e(__('Zitopay Logo')); ?></strong></label>
                                                            <div class="media-upload-btn-wrapper">
                                                                <div class="img-wrap">
                                                                    <?php
                                                                        $marcadopago_img = get_attachment_image_by_id(get_static_option('zitopay_preview_logo'),null,true);
                                                                        $marcadopago_image_btn_label = __('Upload Image');
                                                                    ?>
                                                                    <?php if(!empty($midtrans_img)): ?>
                                                                        <div class="attachment-preview">
                                                                            <div class="thumbnail">
                                                                                <div class="centered">
                                                                                    <img class="avatar user-thumb" src="<?php echo e($marcadopago_img['img_url']); ?>" alt="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php  $marcadopago_image_btn_label = __('Change Image'); ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <input type="hidden" name="zitopay_preview_logo" value="<?php echo e(get_static_option('zitopay_preview_logo')); ?>">
                                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                                    <?php echo e(__($mollie_image_btn_label)); ?>

                                                                </button>
                                                            </div>
                                                            <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="zitopay_username"><?php echo e(__('Zitopay Username')); ?></label>
                                                            <input type="text" name="zitopay_username"  value="<?php echo e(get_static_option('zitopay_username')); ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            

                                            <div class="card">
                                                <div class="card-header" id="cash_on_delivery_settings">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapsed" type="button"
                                                                data-toggle="collapse"
                                                                data-target="#pcash_on_delivery_settings_content"
                                                                aria-expanded="false">
                                                            <span class="page-title"> <?php echo e(__('Cash On Delivery Settings')); ?></span>
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="pcash_on_delivery_settings_content" class="collapse"
                                                     data-parent="#accordion-payment">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label for="cash_on_delivery_gateway"><strong><?php echo e(__('Enable Cash On Delivery')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="cash_on_delivery_gateway"
                                                                       <?php if(!empty(get_static_option('cash_on_delivery_gateway'))): ?> checked
                                                                       <?php endif; ?> id="cash_on_delivery_gateway">
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="site_logo"><strong><?php echo e(__('Cash On Delivery Logo')); ?></strong></label>
                                                            <div class="media-upload-btn-wrapper">
                                                                <div class="img-wrap">
                                                                    <?php
                                                                        $paypal_img = get_attachment_image_by_id(get_static_option('cash_on_delivery_preview_logo'),null,true);
                                                                        $paypal_image_btn_label = 'Upload Image';
                                                                    ?>
                                                                    <?php if(!empty($paypal_img)): ?>
                                                                        <div class="attachment-preview">
                                                                            <div class="thumbnail">
                                                                                <div class="centered">
                                                                                    <img class="avatar user-thumb"
                                                                                         src="<?php echo e($paypal_img['img_url']); ?>"
                                                                                         alt="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php  $paypal_image_btn_label = 'Change Image'; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <input type="hidden" id="cash_on_delivery_preview_logo"
                                                                       name="cash_on_delivery_preview_logo"
                                                                       value="<?php echo e(get_static_option('cash_on_delivery_preview_logo')); ?>">
                                                                <button type="button"
                                                                        class="btn btn-info media_upload_form_btn"
                                                                        data-btntitle="Select Image"
                                                                        data-modaltitle="Upload Image"
                                                                        data-toggle="modal"
                                                                        data-target="#media_upload_modal">
                                                                    <?php echo e(__($paypal_image_btn_label)); ?>

                                                                </button>
                                                            </div>
                                                            <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header" id="manual_payment_settings">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button"
                                                                data-toggle="collapse"
                                                                data-target="#manual_payment_settings_content"
                                                                aria-expanded="false">
                                                            <span class="page-title"> <?php echo e(__('Manual Payment Settings')); ?></span>
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="manual_payment_settings_content" class="collapse"
                                                     data-parent="#accordion-payment">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label for="manual_payment_gateway"><strong><?php echo e(__('Enable/Disable Manual Payment')); ?></strong></label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="manual_payment_gateway"
                                                                       <?php if(!empty(get_static_option('manual_payment_gateway'))): ?> checked
                                                                       <?php endif; ?> id="manual_payment_gateway">
                                                                <span class="slider onff"></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="site_logo"><strong><?php echo e(__('Manual Payment Logo')); ?></strong></label>
                                                            <div class="media-upload-btn-wrapper">
                                                                <div class="img-wrap">
                                                                    <?php
                                                                        $paytm_img = get_attachment_image_by_id(get_static_option('manual_payment_preview_logo'),null,false);
                                                                        $paytm_image_btn_label = __('Upload Image');
                                                                    ?>
                                                                    <?php if(!empty($paytm_img)): ?>
                                                                        <div class="attachment-preview">
                                                                            <div class="thumbnail">
                                                                                <div class="centered">
                                                                                    <img class="avatar user-thumb"
                                                                                         src="<?php echo e($paytm_img['img_url']); ?>"
                                                                                         alt="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php  $paytm_image_btn_label = __('Change Image'); ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <input type="hidden" id="manual_payment_preview_logo"
                                                                       name="manual_payment_preview_logo"
                                                                       value="<?php echo e(get_static_option('manual_payment_preview_logo')); ?>">
                                                                <button type="button"
                                                                        class="btn btn-info media_upload_form_btn"
                                                                        data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                                        data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                                                                        data-toggle="modal"
                                                                        data-target="#media_upload_modal">
                                                                    <?php echo e(__($paytm_image_btn_label)); ?>

                                                                </button>
                                                            </div>
                                                            <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="site_manual_payment_name"><?php echo e(__('Manual Payment Name')); ?></label>
                                                            <input type="text" name="site_manual_payment_name"
                                                                   id="site_manual_payment_name"
                                                                   value="<?php echo e(get_static_option('site_manual_payment_name')); ?>"
                                                                   class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="site_manual_payment_description"><?php echo e(__('Manual Payment Description')); ?></label>
                                                            <textarea class="summernote" name="site_manual_payment_description"><?php echo e(get_static_option('site_manual_payment_description')); ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                            <?php echo (new \App\Helpers\ModuleMetaData())->renderAllPaymentGatewaySettingsBlade(); ?>

                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.markup','data' => []]); ?>
<?php $component->withName('media.markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.js','data' => []]); ?>
<?php $component->withName('media.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <script src="<?php echo e(asset('assets/backend/js/summernote-bs4.js')); ?>"></script>
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.icon-picker','data' => []]); ?>
<?php $component->withName('icon-picker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.btn.update','data' => []]); ?>
<?php $component->withName('btn.update'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                $('.summernote').summernote({
                    height: 150,   //set editable area's height
                    codemirror: { // codemirror options
                        theme: 'monokai'
                    }
                });
            });
        }(jQuery));
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/backend/general-settings/payment-gateway.blade.php ENDPATH**/ ?>