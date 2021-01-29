<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->string('inventrable_type');
            $table->unsignedBigInteger('inventrable_id');
            $table->integer('quantity');
            $table->integer('price');
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('inventrable_id')->references('id')->on('suppliers');

            // $table->foreign('user_id')->references('id')->on('users');
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
