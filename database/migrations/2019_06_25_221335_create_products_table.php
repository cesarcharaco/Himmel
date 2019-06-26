<?php

use Illuminate\Support\Facades\Schema;
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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('characteriscs');
            $table->integer('existence');
            $table->enum('unity',['Caja','Bulto','Resma','Paquete','kilo','Barril','Litros','Otro']);
            $table->float('price_ind');
            $table->float('price_und');
            $table->integer('stock_min');
            $table->integer('stock_max');

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
        Schema::dropIfExists('products');
    }
}
