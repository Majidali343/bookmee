<?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type === 1): ?>
        <div class="chat-container-footer">
            
            <div class="mobile-overlay"></div>
            <div class="chat-wrapper-area chat-popup" id="myForm">
                <div class="chat-wrapper-conversation">
                    <div id="app">
                        <div class="row-flex-item">
                            <div class="col-lg-8-item">
                                <div class="chat-showing-item">
                                    <div id="chat-overlay" class="row-"></div>

                                    <audio id="chat-alert-sound" style="display: none">
                                        <source src="<?php echo e(asset('assets/uploads/sound/facebook_chat.mp3')); ?>" />
                                    </audio>
                                    <?php echo $__env->make('livechat::frontend.buyer.chat-box', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>
                            <div class="chat-mobile-icon">
                                <i class="las la-bars"></i>
                            </div>
                            <div class="col-lg-4-item" id="col-lg-4-item">
                                <input type="hidden" id="current_user" value="<?php echo e(\Auth::guard('web')->user()->id); ?>"/>
                                <div class="conversation-start">
                                    <?php
                                        $sellers = \Modules\LiveChat\Entities\LiveChatMessage::select('seller_id')
                                                  ->with('sellerList')
                                                  ->distinct('seller_id')
                                                  ->where('seller_id','!=',NULL)
                                                  ->where('buyer_id', Auth::guard('web')->user()->id)
                                                  ->get();
                                    ?>

                                    <?php if($sellers->count() > 0): ?>
                                        <div class="chat-showing-person">
                                            <div class="public-chat-flex">
                                                <h5 class="panel-title"><?php echo e(__('All Contacts')); ?></h5>
                                                <div class="public-chat-btn">
                                                    <button type="button" class="btn-icon" onclick="minimizeForm()"><i class="las la-minus"></i></button>
                                                </div>
                                            </div>
                                            <div class="input-name-search-field custom-form">
                                                <input class="form-control" type="text" placeholder="<?php echo e(__('Search Name')); ?>" id="chat_name_search_text">
                                            </div>
                                            <div class="seller_container">
                                                <ul class="user-profile-chat margin-top-30" id="users">
                                                    <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            $user_image = get_attachment_image_by_id(optional($seller->sellerList)->image);
                                                        ?>
                                                        <li>
                                                            <a href="javascript:void(0);" class="chat-toggle"data-id="<?php echo e(optional($seller->sellerList)->id); ?>"data-user="<?php echo e(optional($seller->sellerList)->name); ?>" data-user_image="<?php echo e(!empty($user_image) ? $user_image["img_url"] : null); ?>">
                                                                <div class="chat-bg bg-image" <?php echo render_background_image_markup_by_attachment_id(optional($seller->sellerList)->image); ?>> <span class="notification-dot active"></span> </div>
                                                                <h4 class="chat-author-title"> <?php echo e(optional($seller->sellerList)->name); ?> </h4>
                                                            </a>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <p class="no-contact-found"><?php echo e(__('No Contacts Yet')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <?php if(!Auth::guard('web')->check()): ?>
            <?php if(get_static_option('login_text_show_hide') == 'yes'): ?>
                <button class="open-button"> <i class="las la-comments"></i> <?php echo e(__('Login To Chat')); ?></button>
            <?php endif; ?>

        <div class="mobile-overlay"></div>
            <div class="chat-wrapper-area chat-popup" id="myForm">
                <div class="chat-wrapper-conversation">
                    <div id="app">
                        <div class="row-flex-item">
                            <div class="chat-mobile-icon">
                                <i class="las la-bars"></i>
                            </div>
                            <div class="col-lg-4-item" id="col-lg-4-item">
                                <div class="conversation-start">
                                        <div class="chat-showing-person">
                                            <div class="public-chat-flex">
                                                <?php if(get_static_option('login_text_show_hide') == 'yes'): ?>
                                                <h5 class="panel-title"><?php echo e(__('Login to Chat')); ?></h5>
                                                <?php endif; ?>
                                                <div class="public-chat-btn">
                                                    <button type="button" class="btn-icon" onclick="minimizeForm()"><i class="las la-minus"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-item-4-form-style">
                                                <p class="mt-3 error_message"></p>
                                                <small class="please_login_text"><?php echo e(__('Please login to start chat with seller')); ?></small>
                                                <div class="email custom-form mt-2">
                                                    <input class="form-control" type="email" placeholder="<?php echo e(__('Email or Username')); ?>" name="user_login_email" id="user_login_email">
                                                </div>
                                                <div class="email custom-form mt-2">
                                                    <input class="form-control" type="password" placeholder="<?php echo e(__('Password')); ?>" name="user_login_password" id="user_login_password">
                                                </div>
                                                <button class="form-control mt-2 login_to_chat"><?php echo e(__('Login')); ?></button>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php endif; ?>
    <?php endif; ?>

    <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type === 0): ?>
        <button class="open-button"> <i class="las la-comments"></i> <?php echo e(__('Chat')); ?></button>
        <div class="mobile-overlay"></div>
        <div class="chat-wrapper-area chat-popup" id="myForm">
            <div class="chat-wrapper-conversation">
                <div id="app">
                    <div class="row-flex-item">
                        <div class="col-lg-8-item">
                            <div class="chat-showing-item">
                                <div id="chat-overlay" class="row-"></div>

                                <audio id="chat-alert-sound" style="display: none">
                                    <source src="<?php echo e(asset('assets/uploads/sound/facebook_chat.mp3')); ?>" />
                                </audio>
                                <?php echo $__env->make('livechat::frontend.seller.chat-box', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                        <div class="chat-mobile-icon">
                            <i class="las la-bars"></i>
                        </div>
                        <div class="col-lg-4-item" id="col-lg-4-item">
                            <input type="hidden" id="current_user" value="<?php echo e(\Auth::user()->id); ?>"/>
                            <div class="conversation-start">
                                <?php
                                    $buyers = \Modules\LiveChat\Entities\LiveChatMessage::select('buyer_id')
                                        ->with('buyerList')
                                        ->distinct('buyer_id')
                                        ->where('buyer_id','!=',NULL)
                                        ->where('seller_id', Auth::guard('web')->user()->id)
                                        ->get();
                                ?>

                                <?php if($buyers->count() > 0): ?>
                                    <div class="chat-showing-person">
                                        <div class="public-chat-flex">
                                            <h5 class="panel-title"><?php echo e(__('All Contacts')); ?></h5>
                                            <div class="public-chat-btn">
                                                <button type="button" class="btn-icon" onclick="minimizeForm()"><i class="las la-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="input-name-search-field custom-form">
                                            <input class="form-control" type="text" placeholder="<?php echo e(__('Search Name')); ?>" id="chat_name_search_text">
                                        </div>
                                        <div class="seller_container">
                                            <ul class="user-profile-chat margin-top-30" id="users">
                                                <?php $__currentLoopData = $buyers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $user_image = get_attachment_image_by_id(optional($buyer->buyerList)->image);
                                                    ?>
                                                    <li>
                                                        <a href="javascript:void(0);" class="chat-toggle"data-id="<?php echo e(optional($buyer->buyerList)->id); ?>"data-user="<?php echo e(optional($buyer->buyerList)->name); ?>" data-user_image="<?php echo e(!empty($user_image) ? $user_image["img_url"] : null); ?>">
                                                            <div class="chat-bg bg-image" <?php echo render_background_image_markup_by_attachment_id(optional($buyer->buyerList)->image); ?>> <span class="notification-dot active"></span> </div>
                                                            <h4 class="chat-author-title"> <?php echo e(optional($buyer->buyerList)->name); ?> </h4>
                                                        </a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <p class="no-contact-found"><?php echo e(__('No Contacts Yet')); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/components/livechat/widget-markup.blade.php ENDPATH**/ ?>