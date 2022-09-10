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
        Schema::create('post-photos', function (Blueprint $table){
        $table->unsignedBigInteger('postid');
        $table->unsignedBigInteger('photoid');
        
        $table->foreign('postid')->references('id')->on('posts');
        $table->foreign('photoid')->references('id')->on('photos');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post-photos');
    }
};
