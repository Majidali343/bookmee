<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChildCategoryIdToBuyerJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('buyer_jobs')){
            Schema::table('buyer_jobs', function (Blueprint $table) {
                //child category id
                $table->unsignedBigInteger('child_category_id')->nullable()->after('subcategory_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buyer_jobs', function (Blueprint $table) {
            //
        });
    }
}
