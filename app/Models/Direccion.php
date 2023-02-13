<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $table = 'direccions';

    protected $guarded = ['id', 'created_at', 'updated_at', 'posicion'];

    //Una Orden pertenece a un usuario
    //Relación uno a muchos inversa
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
}
