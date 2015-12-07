<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViolationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('violations', function (Blueprint $table) {

            // Basic Information
            
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id');                 // FK to Users, customer who created the violation (author)
            $table->integer('pro_id')->nullable();      // FK to Users, Profesional awarded
            
            $table->integer('offers');      // Number of offers received
            $table->tinyInteger('status');   // Status, Open, Awarded, etc..
            
            // Generl Info
            $table->text('ecb',100)->nullable();
            $table->text('class',60);  
            $table->text('type',60);
            $table->text('reporter',60);
            $table->text('description');
            
            // Address
            $table->text('address1',100);
            $table->text('address2',100)->nullable();
            $table->text('city',35);            
            $table->char('state',2);
            $table->char('zip',5);
            
            // Status
            $table->boolean('hearing_date_missed');
            $table->boolean('guilt_admit');
            $table->boolean('corrected');
            
            // Court (when guilt not admited)
            $table->timestamp('hearing_date')->nullable();
            $table->text('defense')->nullable();
            
            // Correction (when the violation has been corrected)
            $table->date('correction_date')->nullable();
            $table->text('correction_author',100)->nullable();
            $table->text('contractor')->nullable();
                        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('violations');
    }
}
