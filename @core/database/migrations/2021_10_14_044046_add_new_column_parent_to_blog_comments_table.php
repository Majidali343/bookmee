<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnParentToBlogCommentsTable extends Migration
{

    public function up()
    {
        Schema::table('blog_comments', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('type')->nullable();
        });
    }

    public function down()
    {
        Schema::table('blog_comments', function (Blueprint $table) {
            $table->dropColumn('parent_id');
            $table->dropColumn('type');
        });
    }
}
