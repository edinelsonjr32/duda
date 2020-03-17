<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCollumnEmail2 extends Migration
{
    public function up()
    {
        Schema::table('email', function (Blueprint $table) {
            $table->boolean('enviado')->default(0);
            $table->boolean('recebido')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('email', function (Blueprint $table) {
            $table->dropColumn('enviado');
            $table->dropColumn('recebiido');
        });
    }
}
