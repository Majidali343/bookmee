<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;


class AddedCouponTimeType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_coupons', function (Blueprint $table) {
            $table->string('discount_type_time')->nullable();
            $table->string('start_date')->default(Carbon::now());
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_coupons', function (Blueprint $table) {
            $table->dropColumn('discount_type_time');
            $table->dropColumn('start_date');
        });
    }
}
