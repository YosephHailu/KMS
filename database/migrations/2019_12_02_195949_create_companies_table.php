<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('abbreviation')->nullable();
            $table->string('email');
            $table->string('address')->nullable();
            
            $table->text('phone')->nullable();
            $table->text('fixed_line')->nullable();
            $table->text('fax')->nullable();
            
            $table->text('website')->nullable();
            $table->text('url')->nullable();
            $table->text('fb_url')->nullable();
            $table->text('twitter_url')->nullable();
            $table->text('youtube_url')->nullable();

            $table->text('logo')->nullable();
            $table->text('header_img')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
