<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->double('discount')->nullable();
            $table->string('discount_type')->nullable();
            $table->string('expire_date')->nullable();
            $table->tinyInteger('status')->default('0')->comment('0=inactive 1=active');
            $table->tinyInteger('seller_id')->nullable();
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
        Schema::dropIfExists('service_coupons');
    }
}
