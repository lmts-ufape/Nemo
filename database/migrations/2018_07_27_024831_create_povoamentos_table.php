<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePovoamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('povoamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ciclo_id');
            $table->integer('especie_id');
            $table->dateTime('data');
            $table->integer('quantidade');
            $table->float('peso');


            $table->foreign('ciclo_id')->references('id')->on('ciclos')->onDelete('cascade');
            $table->foreign('especie_id')->references('id')->on('especie_peixes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('povoamentos');
    }
}
