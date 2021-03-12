<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Invoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('invoices',function(Blueprint $table){
        $table->id();
        $table->unsignedBigInteger('distributor_id');
        $table->integer('amount');
        $table->date('month');
        $table->dateTime('due_date');
        $table->date('has_paid');
        $table->string('pdf');
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
