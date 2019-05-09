<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePescasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pescas', function (Blueprint $table) {
            $table->increments('id');
            $table->float('peso')->unsigned();
            $table->date('data');
            $table->time('hora');
            $table->timestamps();
            $table->integer('ciclo_id');


            $table->foreign('ciclo_id')->references('id')->on('ciclos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pescas');
    }
}
