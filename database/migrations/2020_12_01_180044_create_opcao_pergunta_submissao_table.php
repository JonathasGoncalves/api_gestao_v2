<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpcaoPerguntaSubmissaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opcao_pergunta_submissao', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';

            $table->increments('id');
            $table->unsignedInteger('opcao_pergunta_id');
            $table->unsignedInteger('submissao_id');
            $table->timestamps();

            $table->foreign('opcao_pergunta_id')->references('id')->on('opcao_pergunta');
            $table->foreign('submissao_id')->references('id')->on('submissao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opcao_pergunta_submissao');
    }
}
