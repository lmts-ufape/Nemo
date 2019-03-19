<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGerenciarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gerenciars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('piscicultura_id');
            $table->integer('is_administrador')->default('1');

            $table->unique(['user_id', 'piscicultura_id']);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('gerenciars');
    }
}
