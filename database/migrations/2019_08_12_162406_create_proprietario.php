<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProprietario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proprietario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome')->nullable();
            $table->unsignedBigInteger('tipo_proprietario_id');
            $table->foreign('tipo_proprietario_id')->references('id')->on('tipo_proprietario')->onDelete('cascade');
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('email')->nullable();
            $table->string('telefone')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('rua')->nullable();
            $table->string('profissao')->nullable();
            $table->string('nacionalidade')->nullable();
            $table->string('nome_empresa')->nullable();
            $table->string('contrato_social')->nullable();
            $table->string('orgao_emissor')->nullable();
            $table->string('tipo_conta')->nullable();
            $table->string('variacao_poupanca')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cpf')->nullable();
            $table->string('rg')->nullable();
            $table->string('cep')->nullable();
            $table->string('cidade')->nullable();
            $table->string('numero_casa')->nullable();
            $table->string('estado')->nullable();
            $table->string('estado_civil')->nullable();
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
        Schema::dropIfExists('proprietario');
    }
}
