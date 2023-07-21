<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->string('profile_background')->nullable();
            $table->string('service_city')->nullable();
            $table->string('service_area')->nullable();
            $table->integer('user_type')->default(0)->comment('0=seller, 1=buyer');
            $table->integer('user_status')->default(1)->comment('0=inactive, 1=active');
            $table->integer('terms_condition')->default(1);
            $table->text('address')->nullable();
            $table->string('state')->nullable();
            $table->text('about')->nullable();
            $table->string('post_code')->nullable();
            $table->string('country_id')->nullable();
            $table->string('email_verified')->nullable();
            $table->text('email_verify_token')->nullable();
            
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
