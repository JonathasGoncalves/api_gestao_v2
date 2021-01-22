<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissao', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';

            $table->increments('id');
            $table->dateTime('DataSubmissao');
            $table->integer('qualidade_id')->nullable();
            $table->unsignedInteger('projeto_id')->nullable();
            $table->integer('tanque_id');
            $table->integer('realizada');
            $table->unsignedInteger('tecnico_id');
            $table->integer('aproveitamento');
            $table->timestamps();

            /**Esse campo é o id de tanques, cada id tem uma combinação de tamque/latão. Deve-se usar essa campo no join e o campo tanques.tanque no select.*/
            $table->foreign('tanque_id')->references('id')->on('tanques');
            $table->foreign('qualidade_id')->references('id')->on('qualidade-leite');
            $table->foreign('projeto_id')->references('id')->on('projeto');
            $table->foreign('tecnico_id')->references('id')->on('tecnicos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submissao');
    }
}
