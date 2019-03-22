<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTanquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanques', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->float('volume')->unsigned();
            $table->float('area')->unsigned();
            $table->float('altura')->unsigned();
            $table->string('formato');
            $table->string('manutencao_necessaria')->default("Não");
            $table->integer('piscicultura_id');

            $table->foreign('piscicultura_id')->references('id')->on('pisciculturas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tanques');
    }
}