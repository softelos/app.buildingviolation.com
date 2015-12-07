<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            
            // Basic
            $table->increments('id');
            $table->timestamps();
            
            // Custom
            $table->string('introduction',150);
            $table->text('approach',1000);
            $table->decimal('cost',6,2)->nullable();
            $table->integer('days')->nullable();
            $table->boolean('awarded')->default(false);
            $table->tinyInteger('status')->default(0);
            $table->boolean('paid')->default(false);
            
            // Foreing keys
            $table->integer('pro_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('violation_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('offers');
    }
}
