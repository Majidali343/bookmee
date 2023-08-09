<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StaffEmailCanEmpty extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('staff_services', function (Blueprint $table) {
            $table->String('email')->nullable()->change();
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
            $table->String('email')->change();
        });
    }
}
