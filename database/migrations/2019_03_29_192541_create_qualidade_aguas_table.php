<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualidadeAguasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualidade_aguas', function (Blueprint $table) {
        	$table->increments('id');
            $table->integer("ciclo_id")->unsigned();

            $table->timestamps();
            
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
        Schema::dropIfExists('qualidade_aguas');
    }
}
