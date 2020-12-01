<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespostaPerguntaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resposta_pergunta', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';

            $table->increments('id');
            $table->unsignedInteger('resposta_escrita_id');
            $table->unsignedInteger('pergunta_id');
            $table->timestamps();

            $table->foreign('resposta_escrita_id')->references('id')->on('resposta_escrita');
            $table->foreign('pergunta_id')->references('id')->on('pergunta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resposta_pergunta');
    }
}
