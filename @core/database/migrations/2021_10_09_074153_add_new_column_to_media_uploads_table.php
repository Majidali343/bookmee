<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToMediaUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media_uploads', function (Blueprint $table) {
            if (!Schema::hasColumn('media_uploads','type')){
                $table->string('type',10)->default('admin');
            }
            if (!Schema::hasColumn('media_uploads','user_id')){
                $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::table('media_uploads', function (Blueprint $table) {
            if (Schema::hasColumn('media_uploads','type')){
                $table->dropColumn('type');
            }
            if (Schema::hasColumn('media_uploads','user_id')){
                $table->dropColumn('user_id');
            }
        });
    }
}
