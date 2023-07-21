<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDataTypeOfOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $this->changeColumnType('orders','city','bigint(11)');
            $this->changeColumnType('orders','country','bigint(11)');
            $this->changeColumnType('orders','area','bigint(11)');
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
        Schema::table('orders', function (Blueprint $table) {
            $this->changeColumnType('orders','city','tinyint(11)');
            $this->changeColumnType('orders','country','tinyint(11)');
            $this->changeColumnType('orders','area','tinyint(11)');
        });
    }
}
