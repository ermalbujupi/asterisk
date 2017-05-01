<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrand extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('info')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->integer('system_deleted');
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
        Schema::drop('brands');
    }
}
