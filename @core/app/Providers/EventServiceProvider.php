<?php

namespace App\Providers;

use App\Events\AttendanceBooking;
use App\Events\DonationSuccess;
use App\Listeners\AttendanceBookingDatabaseUpdate;
use App\Listeners\AttendanceBookingSuccessMailSendAdmin;
use App\Listeners\AttendanceBookingSuccessMailSendUser;
use App\Listeners\DonationDatabaseUpdate;
use App\Listeners\DonationSuccessMailSend;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\SupportMessage;
use App\Listeners\SupportSendMailToAdmin;
use App\Listeners\SupportSendMailToUser;
use App\Listeners\SupportSendMailToSeller;
use App\Listeners\SupportSendMailToBuyer;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SupportMessage::class => [
            SupportSendMailToAdmin::class,
            SupportSendMailToUser::class,
            SupportSendMailToSeller::class,
            SupportSendMailToBuyer::class,
        ],
        DonationSuccess::class => [
            DonationDatabaseUpdate::class,
            DonationSuccessMailSend::class
        ],
         AttendanceBooking::class => [
            AttendanceBookingDatabaseUpdate::class,
            AttendanceBookingSuccessMailSendAdmin::class,
            AttendanceBookingSuccessMailSendUser::class
        ],
    ];

    public function boot()
    {
        parent::boot();

        //
    }
}
