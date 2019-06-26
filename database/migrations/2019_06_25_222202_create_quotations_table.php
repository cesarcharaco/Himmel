<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id');
            $table->text('comments')->nullable();
            $table->float('discount')->nullable();
            $table->string('offer_validity');
            $table->text('place_delivery');
            $table->string('delivery_term');
            $table->enum('way_pay',['Transferencia','Efectivo']);
            $table->enum('coin',['Dolar USD','Pesos','Soles','Bitcoin','Otro']);
            $table->string('addressed_to')->nullable();
            $table->text('email_comments')->nullable();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

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
        Schema::dropIfExists('quotations');
    }
}
