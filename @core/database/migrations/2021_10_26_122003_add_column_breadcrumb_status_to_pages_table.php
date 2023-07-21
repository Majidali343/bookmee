<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnBreadcrumbStatusToPagesTable extends Migration
{

    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('breadcrumb_status')->nullable();

        });
    }

    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('breadcrumb_status');
        });
    }
}
