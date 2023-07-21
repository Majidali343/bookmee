<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialIconsTable extends Migration
{

    public function up()
    {
        Schema::create('social_icons', function (Blueprint $table) {
            $table->id();
            $table->string('icon');
            $table->string('url');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('social_icons');
    }
}
