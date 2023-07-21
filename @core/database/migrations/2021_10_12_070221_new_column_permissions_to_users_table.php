<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewColumnPermissionsToUsersTable extends Migration
{

    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('auto_post_approval')->default(1);
            $table->string('is_banned')->default(1);
            $table->string('post_permission')->default(1);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('auto_post_approval');
            $table->dropColumn('is_banned');
            $table->dropColumn('post_permission');
        });
    }
}
