<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDataTypeOfServicebenifitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servicebenifits', function (Blueprint $table) {
            $this->changeColumnType('servicebenifits','service_id','bigint(11)');
            $this->changeColumnType('servicebenifits','seller_id','bigint(11)');
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
        Schema::table('servicebenifits', function (Blueprint $table) {
            $this->changeColumnType('servicebenifits','service_id','tinyint(11)');
            $this->changeColumnType('servicebenifits','seller_id','tinyint(11)');
        });
    }
}
