<?php

use App\Models\Cupon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupons', function (Blueprint $table) {
            $table->id();

            $table->string('codigo')->unique();
            $table->enum('tipo', [Cupon::FIJO, Cupon::PORCENTAJE])->default(Cupon::FIJO);
            $table->float('descuento');
            $table->float('carrito_monto')->default(0);
            $table->unsignedInteger('limite')->default(100);
            $table->unsignedInteger('usado')->default(0);
            $table->date('fecha_inicio')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->date('fecha_expiracion');

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
        Schema::dropIfExists('cupons');
    }
};
