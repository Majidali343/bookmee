<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('subscription_id');
            $table->bigInteger('seller_id');
            $table->string('type')->nullable();
            $table->bigInteger('connect')->default(0);
            $table->double('price')->default(0);
            $table->string('coupon_code')->nullable();
            $table->string('coupon_type')->nullable();
            $table->string('coupon_amount')->default(0);
            $table->timestamp('expire_date')->nullable();
            $table->string('payment_gateway')->nullable();
            $table->string('payment_status')->nullable();
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
        Schema::dropIfExists('subscription_histories');
    }
}
