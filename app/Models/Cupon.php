<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    use HasFactory;

    protected $table = "cupons";

    const FIJO = "fijo";
    const PORCENTAJE = "porcentaje";

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'cliente_cupon');
    }

    public function clientesCupones()
    {
        return $this->hasMany(ClienteCupon::class);
    }

}
