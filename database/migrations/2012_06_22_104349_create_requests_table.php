<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id');
           
            $table->integer('request_sender');
            $table->integer('request_reciever_1')->unsigned();
            $table->integer('request_reciever_2')->unsigned();
            $table->boolean('status_1')->default(false);
            $table->boolean('status_2')->default(false);
           // $table->foreign('request_reciever_1')->references('id')->on('users');
            //$table->foreign('request_reciever_2')->references('id')->on('users');


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
        Schema::dropIfExists('requests');
    }
}
