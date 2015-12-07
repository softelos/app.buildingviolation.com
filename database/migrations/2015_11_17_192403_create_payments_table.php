<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            // Generic
            $table->increments('id');
            $table->timestamps();
            
            // Custom
            $table->decimal('fee',5,2)->required();            
            $table->decimal('cost',5,2)->required();
            $table->decimal('bv_cost',5,2)->required();
            $table->decimal('total',5,2)->required();
            
            $table->binary('paid')->required()->default(false);
            
            // Foreign keys
            $table->integer('offer_id')->required();    // Offer that the payment was for
            $table->integer('user_id')->required();     // User who paid the offer
             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payments');
    }
}
