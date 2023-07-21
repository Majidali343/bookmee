<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('category_id')->nullable;
            $table->tinyInteger('subcategory_id')->nullable;
            $table->tinyInteger('seller_id');
            $table->tinyInteger('service_city_id');
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->string('image')->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('is_service_on')->default(1);
            $table->double('price')->default(0);
            $table->double('tax')->default(0);
            $table->double('view')->default(0);
            $table->tinyInteger('featured')->default(0);
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
        Schema::dropIfExists('services');
    }
}
