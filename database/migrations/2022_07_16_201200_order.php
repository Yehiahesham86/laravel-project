<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('item_id');
            $table->integer('qty');
            $table->integer('price');
            $table->integer('okey');
            $table->string('product');
            $table->string('customer');
            $table->string('prodectid');
            $table->integer('total');

            $table->unsignedBigInteger('user_id')->nullable();
           
       
            $table->timestamps();
           
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Orders');
    }
};
