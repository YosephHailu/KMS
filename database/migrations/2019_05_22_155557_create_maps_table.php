<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('created_date')->nullable();
            
            $table->unsignedBigInteger('map_type_id');
            $table->unsignedBigInteger('knowledge_product_id');

            $table->foreign('map_type_id')
                ->references('id')
                ->on('map_types')->onDelete('cascade')->onUpdate('cascade'); 
            
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
        Schema::dropIfExists('maps');
    }
}
