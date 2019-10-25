<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserNoticeBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_notice_boards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('seen')->nullable();
            $table->date('seen_at')->nullable();
            $table->unsignedBigInteger('user_id');

            $table->unsignedBigInteger('notice_board_id');

            $table->foreign('notice_board_id')
                ->references('id')
                ->on('notice_boards')->onDelete('cascade')->onUpdate('cascade'); 
            
            $table->foreign('user_id')
                ->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade'); 
            
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
        Schema::dropIfExists('user_notice_boards');
    }
}
