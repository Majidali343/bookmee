<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountdeactivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accountdeactives', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('reason');
            $table->text('description');
            $table->integer('status')->nullable();
            $table->integer('account_status')->nullable();
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
        Schema::dropIfExists('accountdeactives');
    }
}
