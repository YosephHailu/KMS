<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKnowledgeRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledge_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('rating');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('knowledge_product_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade'); 
            
            $table->foreign('knowledge_product_id')
                ->references('id')
                ->on('knowledge_products')->onDelete('cascade')->onUpdate('cascade'); 
                
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
        Schema::dropIfExists('knowledge_ratings');
    }
}
