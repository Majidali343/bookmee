<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddingStaffids extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('serviceincludes', function (Blueprint $table) {
            $table->json('staff_ids')->nullable();
            $table->string('service_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('serviceincludes', function (Blueprint $table) {
            $table->json('staff_ids')->nullable();
            $table->string('service_time')->nullable();
        });
    }
}
