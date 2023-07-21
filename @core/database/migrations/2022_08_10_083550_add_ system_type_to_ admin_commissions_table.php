<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//rks.com/@core/database/migrations/2022_08_10_083550_add_ system_type_to_admin_commissions_table.php
class AddSystemTypeToAdminCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_commissions', function (Blueprint $table) {
            if (!Schema::hasColumn('admin_commissions','system_type')){
                $table->string('system_type')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_commissions', function (Blueprint $table) {
            if (Schema::hasColumn('admin_commissions','system_type')){
                $table->dropColumn('system_type');
            }
        });
    }
}
