<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Compra;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('administrador_id')->nullable();
            $table->unsignedBigInteger('direccion_id')->nullable();
            $table->unsignedBigInteger('direccion_empresa_id')->nullable();
            $table->unsignedBigInteger('cupon_id')->nullable();

            $table->enum('estado', [Compra::PENDIENTE, Compra::PAGADO, Compra::ORDENADO, Compra::ENVIADO, Compra::ENTREGADO, Compra::ANULADO])->default(Compra::PENDIENTE);
            $table->json('eventos')->nullable();
            $table->float('total');
            $table->json('contenido')->nullable();
            $table->float('impuesto')->nullable()->default(18);
            $table->enum('tipo_envio', [1, 2, 3]);
            $table->json('envio')->nullable();
            $table->float('costo_envio');
            $table->string('puntos_usados')->nullable();
            $table->string('puntos_ganados')->nullable();
            $table->string('puntos_dinero')->nullable();
            $table->string('cupon_codigo')->nullable();
            $table->string('cupon_tipo')->nullable();
            $table->string('cupon_descuento')->nullable();
            $table->text('observacion')->nullable();

            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('administrador_id')->references('id')->on('administradors');
            $table->foreign('direccion_id')->references('id')->on('direccions')->onDelete('cascade');
            $table->foreign('direccion_empresa_id')->references('id')->on('direccion_empresas')->onDelete('cascade');
            $table->foreign('cupon_id')->references('id')->on('cupons')->onDelete('set null');

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
        Schema::dropIfExists('ventas');
    }
};
