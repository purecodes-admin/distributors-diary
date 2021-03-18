<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags',function(Blueprint $table){
            $table->id();
            $table->string('label');
            $table->string('slug');
            $table->integer('has_global');
            $table->unsignedBigInteger('distributor_id');
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
