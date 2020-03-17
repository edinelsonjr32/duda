<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCollumnTableImovel2 extends Migration
{
    public function up()
    {
        Schema::table('imovel', function (Blueprint $table){
           $table->boolean('copa')->default(false)->nullable();
           $table->boolean('terraco')->default(false)->nullable();
           $table->boolean('quarto_empregada')->default(false)->nullable();
           $table->boolean('banheiro_empregada')->default(false)->nullable();
           $table->boolean('sala_com_lareira')->default(false)->nullable();
           $table->boolean('banheiro_social')->default(false)->nullable();
           $table->boolean('placa')->default(false)->nullable();
           $table->double('tamanho_frente')->nullable()->nullable();
           $table->double('tamanho_fundo')->nullable()->nullable();
           $table->boolean('documentado')->default(false)->nullable();
           $table->boolean('recibo_compra_venda')->default(false)->nullable();
           $table->boolean('exclusividade')->default(false)->nullable();

        });
    }
    public function down()
    {
        Schema::table('imovel', function (Blueprint $table){
            $table->dropColumn('copa');
            $table->dropColumn('terraco');
            $table->dropColumn('quarto_empregada');
            $table->dropColumn('banheiro_empregada');
            $table->dropColumn('sala_com_lareira');
            $table->dropColumn('banheiro_social');
            $table->dropColumn('placa');
            $table->dropColumn('tamanho_frente');
            $table->dropColumn('tamanho_fundo');
            $table->dropColumn('documentado');
            $table->dropColumn('recibo_compra_venda');
            $table->dropColumn('exclusividade');

        });
    }
}
