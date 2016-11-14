<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->float('price');
            $table->integer('type_id');
            $table->integer('stock_id');
        });

        Schema::create('types', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('stock', function(Blueprint $table){
            $table->increments('id');
            $table->string('option');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
        Schema::drop('types');
        Schema::drop('stock');
    }
}
