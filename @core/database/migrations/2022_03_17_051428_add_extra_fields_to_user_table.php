<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldsToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = [
                'fb_url',
                'tw_url',
                'go_url',
                'li_url',
                'in_url',
                'twi_url',
                'pi_url',
                'dr_url',
                're_url',
            ];
            foreach ($columns as $column){
                if(!Schema::hasColumn('users',$column)){
                    $table->string($column)->nullable();
                }
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
        Schema::table('users', function (Blueprint $table) {
            $columns = [
                'fb_url',
                'tw_url',
                'go_url',
                'li_url',
                'in_url',
                'twi_url',
                'pi_url',
                'dr_url',
                're_url',
            ];
            foreach ($columns as $column){
                if(Schema::hasColumn('users',$column)){
                    $table->dropColumn($column);
                }
            }
        });
    }
}
