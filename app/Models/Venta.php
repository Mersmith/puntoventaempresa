<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at', 'estado'];

    public function administrador()
    {
        return $this->belongsTo(Administrador::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function direccion()
    {
        return $this->belongsTo(Direccion::class, 'direccion_id', 'id');
    }

    public function direccion_empresa()
    {
        return $this->belongsTo(DireccionEmpresa::class, 'direccion_empresa_id', 'id');
    }

    public function cupon()
    {
        return $this->belongsTo(Cupon::class);
    }

    public function ventaDetalle()
    {
        return $this->hasMany(VentaDetalle::class);
    }
}
