<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->string('codex');
            $table->enum('status',['Sin Aprobar','Aprobada','Cancelada','Ejecutada']);
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
        Schema::dropIfExists('requests_order');
    }
}
