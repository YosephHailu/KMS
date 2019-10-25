<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('job_title');
            $table->string('email')->unique()->nullable();
            $table->string('username')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone');
            $table->string('photo');
            $table->string('password');

            $table->unsignedBigInteger('directorate_id');
            $table->unsignedBigInteger('user_status_id');
            $table->unsignedBigInteger('access_level_id');            
            
            $table->foreign('access_level_id')
                ->references('id')
                ->on('access_levels'); 
            $table->foreign('directorate_id')
                ->references('id')
                ->on('directorates'); 
            $table->foreign('user_status_id')
                ->references('id')
                ->on('user_statuses'); 

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
