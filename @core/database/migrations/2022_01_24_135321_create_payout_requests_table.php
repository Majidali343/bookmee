<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayoutRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payout_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('seller_id');
            $table->double('amount');
            $table->string('payment_gateway')->nullable();
            $table->string('payment_receipt')->nullable();
            $table->text('seller_note')->nullable();
            $table->text('admin_note')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=pending 1=complete, 2=cancelled');
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
        Schema::dropIfExists('payout_requests');
    }
}
