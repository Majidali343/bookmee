<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDataTypeOfSupportTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('support_tickets', function (Blueprint $table) {
            $this->changeColumnType('support_tickets','user_id','bigint(11)');
            $this->changeColumnType('support_tickets','buyer_id','bigint(11)');
            $this->changeColumnType('support_tickets','seller_id','bigint(11)');
            $this->changeColumnType('support_tickets','service_id','bigint(11)');
            $this->changeColumnType('support_tickets','order_id','bigint(11)');
            $this->changeColumnType('support_tickets','admin_id','bigint(11)');
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
        Schema::table('support_tickets', function (Blueprint $table) {
            $this->changeColumnType('support_tickets','user_id','tinyint(11)');
            $this->changeColumnType('support_tickets','buyer_id','tinyint(11)');
            $this->changeColumnType('support_tickets','seller_id','tinyint(11)');
            $this->changeColumnType('support_tickets','service_id','tinyint(11)');
            $this->changeColumnType('support_tickets','order_id','tinyint(11)');
            $this->changeColumnType('support_tickets','admin_id','tinyint(11)');
        });
    }
}
