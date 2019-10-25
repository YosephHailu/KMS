<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKnowledgeProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledge_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('source')->nullable();
            $table->string('contact')->nullable();
            $table->string('keywords')->nullable();
            $table->integer('views')->nullable();
            $table->text('knowledge_description');
            $table->boolean('approved')->default(false);

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('directorate_id');
            $table->unsignedBigInteger('knowledge_category_id');
            $table->unsignedBigInteger('access_level_id');

            $table->foreign('knowledge_category_id')
                ->references('id')
                ->on('knowledge_categories')->onDelete('cascade')->onUpdate('cascade'); 
            
            $table->foreign('user_id')
                ->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade'); 
            
            $table->foreign('directorate_id')
                ->references('id')
                ->on('directorates')->onDelete('cascade')->onUpdate('cascade'); 
  
            $table->foreign('access_level_id')
                ->references('id')
                ->on('access_levels')->onDelete('cascade')->onUpdate('cascade'); 
                
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
        Schema::dropIfExists('knowledge_products');
    }
}
