<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDataTypeOfServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $this->changeColumnType('services','category_id','bigint(11)');
            $this->changeColumnType('services','subcategory_id','bigint(11)');
            $this->changeColumnType('services','seller_id','bigint(11)');
            $this->changeColumnType('services','service_city_id','bigint(11)');
        });
    }
    public function changeColumnType($table, $column, $newColumnType) {
        DB::statement("ALTER TABLE $table CHANGE $column $column $newColumnType");
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $this->changeColumnType('services','category_id','tinyint(11)');
            $this->changeColumnType('services','subcategory_id','tinyint(11)');
            $this->changeColumnType('services','seller_id','tinyint(11)');
            $this->changeColumnType('services','service_city_id','tinyint(11)');
        });
    }
}
