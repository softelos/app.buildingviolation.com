<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            
            // General columns
            $table->increments('id');
            $table->rememberToken();
            $table->timestamps();
            
            // Basic Info
            $table->string('username',60)->unique();
            $table->string('email',254)->unique();
            $table->string('password', 60);
            $table->string('firstname',255)->nullable();
            $table->string('lastname',255)->nullable();
            $table->char('user_type',3);
            $table->string('avatar',255)->nullable()->default('noavatar.jpg');
            
            // Location Info
            $table->string('address1',100)->nullable();
            $table->string('address2',100)->nullable();
            $table->string('city',35)->nullable();            
            $table->char('state',2)->nullable();
            $table->char('zip',5)->nullable();
            $table->char('phone',10)->nullable();
                        
            // Pro Info
            $table->char('pro_type')->nullable();
            $table->string('paypal',254)->nullable();
            $table->boolean('licensed')->nullable()->default(0);
            $table->string('license_number',254)->nullable();
            $table->tinyInteger('completed')->nullable()->default(0);
            $table->tinyInteger('rate_response')->nullable()->default(0);
            $table->tinyInteger('rate_pro')->nullable()->default(0);
            $table->tinyInteger('rate_quality')->nullable()->default(0);
        });

        // Prepopulate with the Admin user
        DB::table('users')->insert([
            'username'=>'admin',
            'password'=>bcrypt('admin'),
            'user_type'=>'admin',
            'email'=>config('other.email'),
            'avatar'=>'noavatar.jpg',
            'created_at'=>Carbon\Carbon::now(),
            'updated_at'=>Carbon\Carbon::now()            
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
  
}
