<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCollumnsImovel4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imovel', function (Blueprint $table){
           $table->string('matricula_celpa')->nullable();
           $table->string('matricula_cosanpa')->nullable();

           //novas colunas adicionada dia 11/11/2019
            $table->boolean('cerca_eletrica')->nullable();
            $table->boolean('poco_artesiano')->nullable();
            $table->boolean('portao_eletronico')->nullable();
            $table->boolean('concertina')->nullable();
            $table->boolean('elevador')->nullable();
            $table->boolean('escada')->nullable();
            $table->boolean('imposto_valor')->nullable();
            $table->boolean('interfone')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imovel', function (Blueprint $table){
            $table->dropColumn('matricula_celpa');
            $table->dropColumn('matricula_cosanpa');
            $table->dropColumn('cerca_eletrica');
            $table->dropColumn('poco_artesiano');
            $table->dropColumn('portao_eletronico');
            $table->dropColumn('concertina');
            $table->dropColumn('elevador');
            $table->dropColumn('imposto_valor');
            $table->dropColumn('escada');
            $table->dropColumn('interfone');
        });
    }
}
