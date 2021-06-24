<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosAgendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos_agenda', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';

            $table->increments('id');
            $table->date('data');
            $table->time('hora');
            $table->unsignedInteger('tecnico_id');
            $table->unsignedInteger('formulario_id');
            $table->unsignedInteger('projeto_id')->nullable();
            $table->integer('tanque_id');
            $table->unsignedInteger('submissao_id');
            $table->timestamps();

            $table->foreign('formulario_id')->references('id')->on('formulario');
            $table->foreign('tecnico_id')->references('id')->on('tecnicos');
            $table->foreign('tanque_id')->references('id')->on('tanques');
            $table->foreign('submissao_id')->references('id')->on('submissoes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventos_agenda');
    }
}
