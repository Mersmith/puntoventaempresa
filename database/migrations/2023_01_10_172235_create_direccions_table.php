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

            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('departamento_id');
            $table->unsignedBigInteger('provincia_id');
            $table->unsignedBigInteger('distrito_id');

            $table->string('nombres');
            $table->string('celular');
            $table->string('direccion');
            $table->string('referencia');
            $table->string('departamento_nombre');
            $table->string('provincia_nombre');
            $table->string('distrito_nombre');
            $table->string('codigo_postal');
            $table->integer('posicion')->default(1);

            $table->foreign('cliente_id')->references('id')->on('clientes');
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
