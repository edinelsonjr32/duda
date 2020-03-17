<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratoProprietarioImobiliaria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrato_proprietario_imobiliaria', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('imovel');
            $table->foreign('imovel')->references('id')->on('imovel')->onDelete('cascade');
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
        Schema::dropIfExists('contrato_proprietario_imobiliaria');
    }
}
