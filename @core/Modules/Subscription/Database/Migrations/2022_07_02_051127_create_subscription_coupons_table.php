<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->double('discount')->nullable();
            $table->string('discount_type')->nullable();
            $table->string('expire_date')->nullable();
            $table->tinyInteger('status')->default('0')->comment('0=inactive 1=active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_coupons');
    }
}
