<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'nombre',
        'apellido',
        'dni',
        'ruc',
        'email',
        'celular',
        'direccion',
        'puntos'
    ];

    public function imagen()
    {
        return $this->morphOne(Imagen::class, "imagenable");
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

    public function direcciones()
    {
        return $this->hasMany(Direccion::class);
    }
    
    public function cupones()
    {
        return $this->belongsToMany(Cupon::class, 'cliente_cupon');
    }

    public function clientesCupones()
    {
        return $this->hasMany(ClienteCupon::class);
    }
   
}
