<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'costo', 'departamento_id'];

    //Una ciudad tiene muchos distritos
    //Relación uno a mucho
    public function distritos()
    {
        return $this->hasMany(Distrito::class);
    }
    
}
