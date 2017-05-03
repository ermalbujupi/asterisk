<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->integer('brand_id')->nullable();
            $table->integer('category_id');
            $table->double('price');
            $table->double('price_decreased')->nullable();
            $table->integer('quantity');
            $table->string('color')->nullable();
            $table->string('imei')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('description')->nullable();
            $table->integer('system_deleted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *x`
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
