<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutorizacaoLocacao extends Migration
{
    public function up()
    {
        Schema::create('autorizacao_locacao', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('proprietarioId');
            $table->foreign('proprietarioId')->references('id')->on('proprietario');
            $table->double('taxa')->nullable();
            $table->date('dataInicio')->nullable();
            $table->date('dataFim')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('autorizacao_locacao');
    }
}
