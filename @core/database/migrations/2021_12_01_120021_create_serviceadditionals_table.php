<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceadditionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serviceadditionals', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('service_id');
            $table->tinyInteger('seller_id');
            $table->string('additional_service_title')->nullable();
            $table->double('additional_service_price')->nullable();
            $table->integer('additional_service_quantity')->nullable();
            $table->string('additional_service_image')->nullable();
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
        Schema::dropIfExists('serviceadditionals');
    }
}
