<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('issued_date')->nullable();
            
            $table->unsignedBigInteger('document_category_id');
            $table->unsignedBigInteger('knowledge_product_id');

            $table->foreign('document_category_id')
                ->references('id')
                ->on('document_categories')->onDelete('cascade')->onUpdate('cascade'); 
            
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
        Schema::dropIfExists('documents');
    }
}
