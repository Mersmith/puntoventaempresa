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
        Schema::create('provincias', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->unsignedBigInteger('departamento_id');
            $table->float('costo')->default('200');

            //Cada vez que eliminamos un Departamento, se elimine tambien las Ciudades asosiados a este Departamento.
            $table->foreign('departamento_id')->references('id')->on('departamentos')->onDelete('cascade');
            
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
        Schema::dropIfExists('provincias');
    }
};
