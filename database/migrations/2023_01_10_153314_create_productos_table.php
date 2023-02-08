<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Producto;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();

            //Identificadores
            $table->unsignedBigInteger('subcategoria_id');
            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('proveedor_id');

            //General
            $table->string('nombre')->unique();
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->float('precio_venta');
            $table->float('precio_real');
            $table->integer('stock_total')->nullable();
            $table->text('descripcion');
            $table->text('informacion');
            $table->integer('puntos_ganar')->default(0);
            $table->integer('puntos_canjeo')->nullable();
            $table->string('link_video')->nullable();
            $table->boolean('incluye_igv')->default(false);
            $table->boolean('tiene_detalle')->default(false);
            $table->text('detalle')->nullable();
            $table->enum('estado', [Producto::DESACTIVADO, Producto::ACTIVADO])->default(Producto::DESACTIVADO);
            $table->integer('visitas')->default(0);

            //Envio
            $table->float('peso')->nullable();
            $table->float('alto')->nullable();
            $table->float('ancho')->nullable();
            $table->float('longitud')->nullable();

            //SEO
            $table->text('meta_titulo')->nullable();
            $table->text('meta_descripcion')->nullable();
            $table->text('meta_claves')->nullable();

            //Relaciones
            $table->foreign('subcategoria_id')->references('id')->on('subcategorias');
            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->foreign('proveedor_id')->references('id')->on('proveedors');

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
        Schema::dropIfExists('productos');
    }
};
