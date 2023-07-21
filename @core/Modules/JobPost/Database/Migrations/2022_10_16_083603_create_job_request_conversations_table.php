<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobRequestConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_request_conversations', function (Blueprint $table) {
            $table->id();
            $table->longText('message')->nullable();
            $table->string('notify')->nullable();
            $table->string('attachment')->nullable();
            $table->string('type')->nullable();
            $table->unsignedBigInteger('job_request_id')->nullable();
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
        Schema::dropIfExists('job_request_conversations');
    }
}
