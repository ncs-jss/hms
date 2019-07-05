<?php

use Illuminate\Support\Facades\Schema;
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
            $table->engine = 'InnoDB';

            $table->Increments('id');
            $table->integer('roll_Number')->unique();
            $table->string('name');
            $table->integer('year');
            $table->boolean('fee_Status')->default(false);
            $table->boolean('result_Status')->default(false);
            $table->integer('UTR_number')->unique();
            $table->boolean('fine')->default(false);
            $table->char('gender', 1);
            $table->integer('User_Room_id')->unsigned()->index();
           // $table->index('User_Room_id');
           // $table->foreign('User_Room_id')->references('Room_id')->on('rooms');

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
        Schema::dropIfExists('users');
    }
}
