<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conditions', function (Blueprint $table) {            
            // Generic
            $table->increments('id');
            $table->timestamps();
            // Custom
            $table->text('body',255)->required();
            $table->date('deadline')->nullable();            
            // Foreing keys
            $table->integer('offer_id')->unsigned()->required;
            $table->integer('pro_id')->unsigned()->required;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('conditions');
    }
}
