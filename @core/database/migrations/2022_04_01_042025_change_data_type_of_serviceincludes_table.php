<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDataTypeOfServiceincludesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('serviceincludes', function (Blueprint $table) {
            $this->changeColumnType('serviceincludes','service_id','bigint(11)');
            $this->changeColumnType('serviceincludes','seller_id','bigint(11)');
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
        Schema::table('serviceincludes', function (Blueprint $table) {
            $this->changeColumnType('serviceincludes','service_id','tinyint(11)');
            $this->changeColumnType('serviceincludes','seller_id','tinyint(11)');
        });
    }
}
