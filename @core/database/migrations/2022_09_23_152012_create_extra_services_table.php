<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('title');
            $table->unsignedBigInteger('quantity');
            $table->double('price');
            $table->string('payment_gateway')->nullable();
            $table->string('manual_payment_gateway_image')->nullable();
            $table->double('tax')->nullable();
            $table->double('commission_amount')->nullable();
            $table->double('sub_total')->nullable();
            $table->double('total')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('payment_status')->nullable();
            $table->unsignedBigInteger('status')->nullable()->comment('0=pending,1=accept,2=decline');
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
        Schema::dropIfExists('extra_services');
    }
}
