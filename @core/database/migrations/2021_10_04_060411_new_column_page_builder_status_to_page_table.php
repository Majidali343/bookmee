<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewColumnPageBuilderStatusToPageTable extends Migration
{

    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('page_builder_status')->nullable();
        });
    }


    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            Schema::dropIfExists('pages');
        });
    }
}
