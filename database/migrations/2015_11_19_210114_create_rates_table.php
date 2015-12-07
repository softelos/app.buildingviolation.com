<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            // Generic
            $table->increments('id');           
            $table->timestamps();
            
            // Particular
            $table->tinyInteger('response')->nullable()->default(0);                        
            $table->tinyInteger('pro')->nullable()->default(0);                        
            $table->tinyInteger('quality')->nullable()->default(0);                        
            // Foreign keys
            $table->integer('pro_id')->required();
            $table->integer('offer_id')->required();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rates');
    }
}
