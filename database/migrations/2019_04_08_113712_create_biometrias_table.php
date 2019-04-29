<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiometriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biometrias', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->double('peso_total');
            $table->double('peso_medio');
            $table->date('data');
            $table->time('hora');
            $table->integer('ciclo_id');
            $table->integer('quantidade');
            
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
        Schema::dropIfExists('biometrias');
    }
}
