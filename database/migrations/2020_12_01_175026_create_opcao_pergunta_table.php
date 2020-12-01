<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpcaoPerguntaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opcao_pergunta', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';

            $table->increments('id');
            $table->unsignedInteger('opcao_id');
            $table->unsignedInteger('pergunta_id');
            $table->integer('positiva');
            $table->timestamps();

            $table->foreign('opcao_id')->references('id')->on('opcao');
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
        Schema::dropIfExists('opcao_pergunta');
    }
}
