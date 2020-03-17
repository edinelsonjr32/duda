<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnexoAutorizacaoLocacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anexo_autorizacao_locacao', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('autorizacaoId');
            $table->foreign('autorizacaoId')->references('id')->on('autorizacao_locacao');
            $table->string('path')->nullable();
            $table->string('nome')->nullable();
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
        Schema::dropIfExists('anexo_autorizacao_locacao');
    }
}
