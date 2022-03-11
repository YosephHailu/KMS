<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('project_title');
            $table->string('contract_no')->nullable();
            $table->text('knowledge_description');
            $table->text('outcome')->nullable();
            $table->text('output')->nullable();
            $table->date('starting_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('beneficiaries_region')->nullable();
            $table->string('wereda_kebele')->nullable();
            $table->string('manager');
            $table->text('project_description')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('knowledge_product_id');
            $table->unsignedBigInteger('project_category_id');
            $table->unsignedBigInteger('directorate_id');
            $table->unsignedBigInteger('project_status_id');
            $table->unsignedBigInteger('access_level_id');            
            
            $table->foreign('knowledge_product_id')
                ->references('id')
                ->on('knowledge_products')->onDelete('cascade')->onUpdate('cascade'); 
            
            $table->foreign('user_id')
                ->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade'); 
            
            $table->foreign('directorate_id')
                ->references('id')
                ->on('directorates')->onDelete('cascade')->onUpdate('cascade'); 

            $table->foreign('project_status_id')
                ->references('id')
                ->on('project_statuses')->onDelete('cascade')->onUpdate('cascade'); 
                
            $table->foreign('access_level_id')
                ->references('id')
                ->on('access_levels')->onDelete('cascade')->onUpdate('cascade'); 
                
            $table->foreign('project_category_id')
                ->references('id')
                ->on('project_categories')->onDelete('cascade')->onUpdate('cascade'); 
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
        Schema::dropIfExists('projects');
    }
}
