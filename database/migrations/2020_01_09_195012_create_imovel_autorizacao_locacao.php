<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImovelAutorizacaoLocacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('imovel_autorizacao_locacao', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('autorizacaoLocacaoId');
            $table->foreign('autorizacaoLocacaoId')->references('id')->on('autorizacao_locacao');
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('imovelId');
            $table->foreign('imovelId')->references('id')->on('imovel');
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
        Schema::dropIfExists('imovel_autorizacao_locacao');
    }
}
