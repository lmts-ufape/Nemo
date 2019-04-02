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
            $table->integer("tanque_id")->unsigned();

            $table->timestamps();
            
            $table->foreign('tanque_id')->references('id')->on('tanques')->onDelete('cascade');
         
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
