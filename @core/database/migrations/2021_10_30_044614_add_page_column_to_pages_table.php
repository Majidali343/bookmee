<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPageColumnToPagesTable extends Migration
{

    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('left_column')->nullable();
            $table->string('right_column')->nullable();
        });
    }

    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('left_column');
            $table->dropColumn('right_column');
        });
    }
}
