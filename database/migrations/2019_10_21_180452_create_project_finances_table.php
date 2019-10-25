<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectFinancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_finances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('budget');
            
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('finance_id');
            $table->unsignedBigInteger('unit_id');         

            $table->foreign('project_id')
                ->references('id')
                ->on('projects')->onDelete('cascade')->onUpdate('cascade'); 
            
            $table->foreign('finance_id')
                ->references('id')
                ->on('finances')->onDelete('cascade')->onUpdate('cascade'); 
            
            $table->foreign('unit_id')
                ->references('id')
                ->on('units')->onDelete('cascade')->onUpdate('cascade'); 
            
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
        Schema::dropIfExists('project_finances');
    }
}
