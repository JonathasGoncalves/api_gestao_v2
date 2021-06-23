<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissoes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';

            $table->increments('id');
            $table->dateTime('DataSubmissao');
            $table->integer('qualidade_id')->nullable();
            $table->integer('realizada');
            $table->integer('aproveitamento');
            $table->timestamps();

            $table->foreign('qualidade_id')->references('id')->on('qualidade-leite');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submissoes');
    }
}
