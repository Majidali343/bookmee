<?php

namespace Database\Seeders;
use App\StaticOption;
use Illuminate\Database\Seeder;

class StaticOptionsTableSeeder extends Seeder
{
    public function run()
    {
        $fields = [
            'user_register_subject34'=>__('New User Registration'),
            'user_register_message45'=>'<p><p>Hello @name,</p><p></p>You have user registered as a @type </p><p> Username: @username  Email: @email<p></p> </p>',
            'user_email_verify_subject'=>__('Verify your email address'),
            'user_email_verify_message'=>'<p><p>Hello @name,</p><p></p>Here is your verification code</p><p><p>Verification Code: @email_verify_tokn</p> </p>',
            'service_approve_subject'=>__('New Service Approve Request'),
            'service_approve_message'=>'<p>Hello,</p><p>
                                         </p><div>
                                        </div><div>New service is just created. Please check for approve, thanks</div><div><br></div><div>
                                        </div><div>Service id: @service_id</div><div>
                                        </div><p></p>',
            'seller_report_subject'=>__('Seller New Report'),
            'seller_report_message'=>'<p>Hello,</p><p>New report is just created by a seller. Please check , thanks</p><p>Report id: @report_id</p>',
            'seller_payout_subject'=>__('Seller Payout Request'),
            'seller_payout_message'=>'<p>Hello,</p><p>
                                         </p><div>
                                        </div><div>New payout request is just created by a seller. Please check , thanks</div><div><br></div><div>
                                        </div><div>Payout request id: @payout_request_id</div><div>
                                        </div><p></p>',

            'seller_order_ticket_subject'=>__('New Order Ticket'),
            'seller_order_ticket_message'=>'<p>Hello,
                                            </p><p>You have a new order ticket
                                            </p><p>Order ticket id: @order_ticket_id</p><p>
                                            </p><p>
                                            </p><div>
                                            </div><p></p>',
            'seller_verification_subject'=>__('Seller Verification Request'),
            'seller_verification_message'=>'<p>Hello,</p><p>
                                             </p><div>
                                            </div><div>You have a new request for seller verification.</div><div>
                                            </div><p></p>',
            'seller_extra_service_subject'=>__('Extra Service Added'),
            'seller_extra_service_message'=>'<p>Hello @seller_name</p><p>You have added extra service in your order.</p><p>Order id: @order_id</p>',
            'seller_to_buyer_extra_service_message'=>'<p>Hello @buyer_name</p><p><br></p><p>
                                                     </p><div>
                                                    </div><div>Seller added extra service in your order.</div><div><br></div><div>Order id: @order_id</div><div>
                                                    </div><p></p>',
            'buyer_order_decline_subject'=>__('Order Complete Request Decline'),
            'buyer_order_decline_message'=>'<p>Your request to complete an order has been decline by the buyer</p><p>Order id: @order_id</p>',
            'buyer_to_admin_extra_service_message'=>'<p>A buyer has been decline a request to complete an order.</p><div><br></div><div>Order id: @order_id</div><div>
                                                     </div><p></p>',
            'buyer_report_subject'=>__('Buyer New Report'),
            'buyer_report_message'=>'<p>Hello,</p><p>New report is just created by a buyer. Please check , thanks</p><p>Report id: @report_id</p>',
            'buyer_order_ticket_subject'=>__('New Order Ticket'),
            'buyer_order_ticket_message'=>'<p>Hello,
                                            </p><p>You have a new order ticket</p><p>Order ticket id: @order_ticket_id</p><p>
                                            </p><p>
                                            </p><div>
                                            </div><p></p>',
            'buyer_extra_service_subject'=>__('Extra Service Excepted'),
            'buyer_extra_service_message'=>'<p>Hello @buyer_name</p><p>You have accepted extra service&nbsp; added by seller in your order.</p><p>Order id: @order_id</p>',
            'buyer_to_seller_extra_service_message'=>'<p>Hello @seller_name</p><p><br></p><p>
                                             </p><div>
                                            </div><div>Buyer accepted the&nbsp; extra service added buy you&nbsp; in your order.</div><div><br></div><div>Order id: @order_id</div><div>
                                            </div><p></p>',
            'admin_change_payment_status_subject'=>__('Payment Status Change'),
            'admin_change_payment_status_message'=>'<p></p><p>Hello @name,
                                                    </p><p>Payment status has been changed @old_status to @new_status
                                                    </p><p>Order id: @order_id</p><p>
                                                    </p><p></p> <p></p>',
            'admin_withdraw_amount_send_message'=>'<p></p><p>Hello @name,
                                                    </p><p>&nbsp;We just send your requested payout amount. Thanks to stay with us.</p><p>Withdraw Amount:&nbsp; @withdraw_amount</p><p>
                                                    </p><p></p> <p></p>',
            'admin_service_approve_subject'=>__('Service Approve Success'),
            'admin_service_approve_message'=>'<p></p><p>Hello @name,</p><p>Your service has been approved by admin.</p><p>
                                                </p><p></p> <p></p>',
            'admin_service_assign_subject'=>__('Service Assign By Admin'),
            'admin_service_assign_message'=>'Hello new service is just assign to you. Please check for details, thanks',
            'admin_seller_verification_subject'=>__('Seller Verification Success'),
            'admin_seller_verification_message'=>'<p></p><p>Hello @name,</p><p>Your verification is success. Now you are a verified seller.</p><p>
                                                    </p><p></p> <p></p>',
            'admin_user_verification_code_subject'=>__('Verification Code Send Success'),
            'admin_user_verification_code_message'=>'<p></p><p>Hello @name,</p><p>Here is your verification code.</p><p>Verification Code: @verification_code</p><p>
                                                    </p><p></p> <p></p>',
            'admin_user_new_password_subject'=>__('Password Change Success'),
            'admin_user_new_password_message'=>'<p>Hello,</p><p>
                                                 </p><div>
                                                </div><div>Here is your new password.</div><div><br></div><div>
                                                </div><div>New password: @new_password</div><div>
                                                </div><p></p>',
            'new_order_email_subject'=>__('New Order'),
            'new_order_buyer_message'=>'<p>You have successfully placed an order #</p>',
            'new_order_admin_seller_message'=>'<p>You have a new order #</p><div>
                                                </div><p></p>',
            'job_apply_subject'=>__('New Application Created'),
            'job_apply_message'=>'<p>Hello,</p><p>
                                     </p><div>
                                    </div><div>New application is created for your job.</div><div><br></div><div>
                                    </div><div>Job post id: @job_post_id</div><div>
                                    </div><p></p>',
            'buy_subscription_email_subject'=>__('New Subscription'),
            'buy_subscription_seller_message'=>'<p>Hello,</p><p>
                                                 <div>
                                                </div><div>You have successfully buy a subscription.
                                                </div><div>Your subscription infos---
                                                </div><div>Subscription type: @type
                                                </div><div>Subscription price: @price
                                                </div><div>Subscription connect: @connect</div><div>
                                                </div><div>
                                                </div><div>
                                                </div><div>
                                                </div></p>',
            'buy_subscription_admin_message'=>'<p>A seller just buy a subscription</p><p>Subscription infos---
                                                </p><p>Subscription type: @type
                                                </p><p>Subscription price: @price
                                                </p><p>Subscription connect: @connect</p><p>Seller name: @seller_name</p><p>Seller email: @seller_email</p>',
            'renew_subscription_email_subject'=>__('Renew Subscription'),
            'renew_subscription_seller_message'=>'<p>Hello,</p><p>
                                                     <div>
                                                    </div><div>You have successfully renew a subscription.</div><div>
                                                    </div><div>Your subscription infos---
                                                    </div><div>Subscription type: @type
                                                    </div><div>Subscription price: @price
                                                    </div><div>Subscription connect: @connect</div></p>',
            'renew_subscription_admin_message'=>'<p>A seller just renew his subscription</p><p>
                                                     <div>
                                                    </div><div>Subscription infos---
                                                    </div><div>Subscription type: @type
                                                    </div><div>Subscription price: @price
                                                    </div><div>Subscription connect: @connect
                                                    </div><div>Seller name: @seller_name
                                                    </div><div>Seller email: @seller_email</div><div>
                                                    </div><div>
                                                    </div><div>
                                                    </div><div>
                                                    </div><div>
                                                    </div></p>',
            'payment_subscription_email_subject'=>__('Subscription Payment Status'),
            'payment_subscription_seller_message'=>'<p>Dear User,</p><p>Your subscription payment status change to complete.</p>',
            ];
        foreach ($fields as $key => $field) {
            StaticOption::updateOrCreate(
                ['option_name' => $key],
                ['option_value' => $field]);
        }
    }
}
