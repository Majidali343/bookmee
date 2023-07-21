<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellerSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('subscription_id');
            $table->bigInteger('seller_id');
            $table->string('type')->nullable();
            $table->bigInteger('connect')->default(0);
            $table->double('price')->default(0);
            $table->bigInteger('initial_connect')->default(0);
            $table->double('initial_price')->default(0);
            $table->double('total')->default(0);
            $table->bigInteger('status')->default(0);
            $table->timestamp('expire_date')->nullable();
            $table->string('payment_gateway')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('manual_payment_image')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('seller_subscriptions');
    }
}
