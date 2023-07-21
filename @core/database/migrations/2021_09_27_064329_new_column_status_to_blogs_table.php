<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewColumnStatusToBlogsTable extends Migration
{

    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->enum('status', ['publish', 'draft','archive','schedule']);
        });
    }


    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            Schema::dropIfExists('blogs');
        });
    }
}
