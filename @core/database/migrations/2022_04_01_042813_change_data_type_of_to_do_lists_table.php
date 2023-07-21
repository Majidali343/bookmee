<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDataTypeOfToDoListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('to_do_lists', function (Blueprint $table) {
            $this->changeColumnType('to_do_lists','user_id','bigint(11)');
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
        Schema::table('to_do_lists', function (Blueprint $table) {
            $this->changeColumnType('to_do_lists','user_id','tinyint(11)');
        });
    }
}
