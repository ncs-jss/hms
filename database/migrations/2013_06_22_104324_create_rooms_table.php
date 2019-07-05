<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
           
            $table->engine = 'InnoDB'; 
            $table->integer('Room_id')->unsigned();
            $table->integer('roll_number_1')->length(11);
            $table->integer('roll_number_2')->length(11);
            $table->integer('roll_number_3')->length(11);
            $table->boolean('room_locked_flag')->default(false);
            $table->char('gender', 1);
            $table->integer('request_ID');
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
        Schema::dropIfExists('rooms');
    }
}
