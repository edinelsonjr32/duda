<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImovel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imovel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('tipo_imovel');
            $table->foreign('tipo_imovel')->references('id')->on('tipo_imovel')->onDelete('cascade');
            $table->boolean('venda')->default(false);
            $table->boolean('aluguel')->default(false);
            $table->double('valor_venda')->nullable();
            $table->double('valor_aluguel')->nullable();
            $table->unsignedBigInteger('proprietario_id');
            $table->foreign('proprietario_id')->references('id')->on('proprietario');
            $table->double('impostos')->nullable();
            $table->double('condominio')->nullable();
            $table->text('descricao')->nullable();
            $table->integer('banheiros')->nullable();
            $table->integer('quartos')->nullable();
            $table->integer('suites')->nullable();
            $table->integer('salas')->nullable();
            $table->integer('garagem')->nullable();
            $table->integer('garagem_coberta')->nullable();
            $table->integer('area_total')->nullable();
            $table->integer('area_util')->nullable();
            $table->string('cep')->nullable();
            $table->string('endereco')->nullable();
            $table->string('bairro')->nullable();
            $table->string('complemento')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->boolean('ar_condicionado')->nullable();
            $table->boolean('bar')->nullable();
            $table->boolean('livraria')->nullable();
            $table->boolean('churrasqueira')->nullable();
            $table->boolean('cozinha_equipada')->nullable();
            $table->boolean('cozinha_americana')->nullable();
            $table->boolean('despensa')->nullable();
            $table->boolean('edicula')->nullable();
            $table->boolean('banheira')->nullable();
            $table->boolean('mobiliado')->nullable();
            $table->boolean('escritorio')->nullable();
            $table->boolean('lavatorio')->nullable();
            $table->boolean('piscina')->nullable();
            $table->boolean('status')->nullable();
            $table->boolean('destaque')->nullable();
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
        Schema::dropIfExists('imovel');

    }
}
