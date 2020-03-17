<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVisita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('data')->nullable();
            $table->time('hora')->nullable();
            $table->unsignedBigInteger('usuario_log');
            $table->foreign('usuario_log')->references('id')->on('users');
            $table->unsignedBigInteger('imovel_id')->nullable();
            $table->unsignedBigInteger('users_id')->nullable();
            $table->foreign('imovel_id')->references('id')->on('imovel');
            $table->foreign('users_id')->references('id')->on('users');
            $table->boolean('status');
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
        Schema::dropIfExists('visitas');
    }
}
