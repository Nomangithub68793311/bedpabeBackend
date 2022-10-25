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
        Schema::create('posts', function (Blueprint $table) {
            $table->uuid('id')->primary();           
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->integer('service');
            $table->string('category');
            $table->string('title');
            $table->string('description');
            $table->integer('email');
            $table->string('phone');
            $table->string('approved')->nullable(); 
            $table->integer('age');
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
        Schema::dropIfExists('posts');
    }
};
