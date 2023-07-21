<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewColumnSidebarToPagesTable extends Migration
{

    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('sidebar_layout')->nullable();
            $table->string('navbar_variant')->nullable();
        });
    }

    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('sidebar_layout');
            $table->string('navbar_variant');
        });
    }
}
