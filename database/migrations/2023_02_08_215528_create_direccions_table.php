<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direccions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');

            $table->string('nombres');
            $table->string('celular');
            $table->string('direccion');
            $table->string('referencia');
            $table->unsignedBigInteger('departamento_id');
            $table->string('departamento_nombre');
            $table->unsignedBigInteger('provincia_id');
            $table->string('provincia_nombre');
            $table->unsignedBigInteger('distrito_id');
            $table->string('distrito_nombre');
            $table->string('codigo_postal');
            $table->integer('posicion')->default(1);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->foreign('provincia_id')->references('id')->on('provincias');
            $table->foreign('distrito_id')->references('id')->on('distritos');

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
        Schema::dropIfExists('direccions');
    }
};
