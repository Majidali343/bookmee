<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportChatMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_chat_messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('report_id');
            $table->bigInteger('admin_id')->nullable();
            $table->bigInteger('seller_id')->nullable();
            $table->bigInteger('buyer_id')->nullable();
            $table->text('message')->nullable();
            $table->string('type')->nullable();
            $table->string('notify')->nullable();
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('report_chat_messages');
    }
}
