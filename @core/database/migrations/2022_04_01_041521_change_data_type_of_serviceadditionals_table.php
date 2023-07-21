<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDataTypeOfServiceadditionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('serviceadditionals', function (Blueprint $table) {
            $this->changeColumnType('serviceadditionals','service_id','bigint(11)');
            $this->changeColumnType('serviceadditionals','seller_id','bigint(11)');
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
        Schema::table('serviceadditionals', function (Blueprint $table) {
            $this->changeColumnType('serviceadditionals','service_id','tinyint(11)');
            $this->changeColumnType('serviceadditionals','seller_id','tinyint(11)');
        });
    }
}
