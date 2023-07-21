<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->text('via')->nullable();
            $table->string('operating_system')->nullable();
            $table->string('user_agent')->nullable();
            $table->longText('description')->nullable();
            $table->text('subject')->nullable();
            $table->string('status')->nullable();
            $table->string('priority')->nullable();
            $table->string('department')->nullable();
            $table->tinyInteger('user_id')->nullable();
            $table->tinyInteger('buyer_id')->nullable();
            $table->tinyInteger('seller_id')->nullable();
            $table->tinyInteger('service_id')->nullable();
            $table->tinyInteger('order_id')->nullable();
            $table->tinyInteger('admin_id')->nullable();
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
        Schema::dropIfExists('support_tickets');
    }
}
