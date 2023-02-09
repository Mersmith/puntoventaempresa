<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at', 'posicion'];

    //Una Orden pertenece a un usuario
    //Relación uno a muchos inversa
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
