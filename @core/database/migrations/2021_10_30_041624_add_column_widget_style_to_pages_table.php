<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnWidgetStyleToPagesTable extends Migration
{

    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('widget_style')->nullable();
        });
    }


    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('widget_style');
        });
    }
}
