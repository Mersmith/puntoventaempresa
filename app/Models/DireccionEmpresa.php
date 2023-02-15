<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DireccionEmpresa extends Model
{
    use HasFactory;

    protected $table = 'direccion_empresas';

    protected $guarded = ['id', 'created_at', 'updated_at', 'posicion'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

}
