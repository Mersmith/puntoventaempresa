<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteCupon extends Model
{
    use HasFactory;

    protected $table = 'cliente_cupon';

    protected $fillable = ['cliente_id', 'cupon_id', 'uso'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function cupon()
    {
        return $this->belongsTo(Cupon::class);
    }

}
