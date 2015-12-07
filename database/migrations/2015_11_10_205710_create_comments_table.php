<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            
            // Basic
            $table->increments('id');
            $table->timestamps();
            
            // Custom
            $table->text('body',255)->required();
            
            // Foreing keys
            $table->integer('user_id')->unsigned();
            $table->integer('offer_id')->unsigned();
                        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments');
    }
}
