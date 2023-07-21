<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyerJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyer_jobs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->nullable;
            $table->bigInteger('subcategory_id')->nullable;
            $table->bigInteger('buyer_id');
            $table->bigInteger('country_id')->default(0);
            $table->bigInteger('city_id')->default(0);
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_job_on')->default(1);
            $table->tinyInteger('is_job_online')->default(0);
            $table->double('price')->default(0);
            $table->bigInteger('view')->default(0);
            $table->timestamp('dead_line')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buyer_jobs');
    }
}
