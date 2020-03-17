<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAutorizacaoLocacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('autorizacao_locacao', function (Blueprint $table) {
            $table->double('taxa2')->nullable();
            $table->double('taxa3')->nullable();
        });
    }

    /**
     * Reverse the migrations.0
     *
     * @return void
     */
    public function down()
    {
        Schema::table('autorizacao_locacao', function (Blueprint $table) {
            $table->dropColumn('taxa2');
            $table->dropColumn('taxa3');
            /*inserção de teste*/
        });
    }
}
