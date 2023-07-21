<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('service_id');
            $table->integer('seller_id');
            $table->integer('buyer_id')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('post_code');
            $table->string('address');
            $table->unsignedBigInteger('city');
            $table->unsignedBigInteger('area');
            $table->unsignedBigInteger('country');
            $table->string('date');
            $table->string('schedule');
            $table->double('package_fee');
            $table->double('extra_service');
            $table->double('sub_total');
            $table->double('tax');
            $table->double('total');
            $table->string('coupon_code')->nullable();
            $table->string('coupon_type')->nullable();
            $table->double('coupon_amount')->nullable();
            $table->string('commission_type')->nullable();
            $table->double('commission_charge')->nullable();
            $table->double('commission_amount')->nullable();
            $table->string('payment_gateway')->nullable();
            $table->string('payment_status')->nullable();
            $table->integer('status')->nullable()->comment('0=pending, 1=active, 2=completed, 3=delivered, 4=cancelled');
            $table->string('transaction_id')->nullable();
            $table->string('order_note')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
