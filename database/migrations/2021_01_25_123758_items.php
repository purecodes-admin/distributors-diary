<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Items extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('distributor_id');
            $table->string('name');
            $table->integer('price');
            $table->integer('stock');
            $table->timestamps();

            $table->foreign('distributor_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
