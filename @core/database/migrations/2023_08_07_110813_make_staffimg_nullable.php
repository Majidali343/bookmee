<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeStaffimgNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('staff_services', function (Blueprint $table) {
            $table->foreignId('profile_image_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('staff_services', function (Blueprint $table) {
            // If you want to revert the change, you can make the column non-nullable again.
            // In this example, I am assuming that the column should be non-nullable.
            $table->foreignId('profile_image_id')->change();
        });
    }
}
