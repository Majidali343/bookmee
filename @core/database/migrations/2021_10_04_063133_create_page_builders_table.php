<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageBuildersTable extends Migration
{

    public function up()
    {
        Schema::create('page_builders', function (Blueprint $table) {
            $table->id();
            $table->string('addon_name')->nullable();
            $table->string('addon_type')->nullable();
            $table->string('addon_namespace')->nullable();
            $table->string('addon_location')->nullable();
            $table->unsignedBigInteger('addon_order')->nullable();
            $table->unsignedBigInteger('addon_page_id')->nullable();
            $table->string('addon_page_type')->nullable();
            $table->longText('addon_settings')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('page_builders');
    }
}
