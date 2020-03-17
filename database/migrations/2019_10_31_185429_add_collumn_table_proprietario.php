<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCollumnTableProprietario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proprietario', function (Blueprint $table) {
            $table->string('cnpj')->nullable();
            $table->string('nome_fantasia')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proprietario', function (Blueprint $table) {
            $table->dropColumn('cnpj');
            $table->dropColumn('nome_fantasia');
        });
    }
}
