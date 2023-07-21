<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnTagsToBlogsTable extends Migration
{

    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->longText('tag_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('tag_id');
        });
    }
}
