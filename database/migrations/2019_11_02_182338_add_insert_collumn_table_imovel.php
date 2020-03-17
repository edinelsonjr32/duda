<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInsertCollumnTableImovel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imovel', function (Blueprint $table){
            $table->double('contribuicao')->nullable();
            $table->double('taxas_extras')->nullable();
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
            $table->dropColumn('contribuicao');
            $table->dropColumn('taxas_extras');
        });
    }
}
