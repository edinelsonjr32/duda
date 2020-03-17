<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCollumnMapaImovel extends Migration
{
    public function up()
    {
        Schema::table('imovel', function (Blueprint $table) {
            $table->string('mapa', 1000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imovel', function (Blueprint $table) {
            $table->dropColumn('mapa');
        });
    }
}
