<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Suppliers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('distributor_id');
            $table->string('name');
            $table->string('address');
            $table->string('email');
            $table->string('contact',11);
            $table->mediumText('discription');
            $table->string('category');
            $table->integer('dues');
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
