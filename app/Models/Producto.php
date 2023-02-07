<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;

class Producto extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'update_at'];

    const DESACTIVADO = 0;
    const ACTIVADO = 1;

    public function getStockAttribute()
    {
        //Solo Medida
        if ($this->subcategoria->tiene_medida && !$this->subcategoria->tiene_color) {
            return MedidaProducto::whereHas('producto', function (Builder $query) {
                $query->where('id', $this->id);
            })->sum('stock');
        }
        //Solo Color
        elseif ($this->subcategoria->tiene_color && !$this->subcategoria->tiene_medida) {
            return ColorProducto::whereHas('producto', function (Builder $query) {
                $query->where('id', $this->id);
            })->sum('stock');
        }
        //Medida y Color
        elseif ($this->subcategoria->tiene_color && $this->subcategoria->tiene_medida) {
            return ColorMedida::whereHas('medida.producto', function (Builder $query) {
                $query->where('id', $this->id);
            })->sum('stock');
        } 
        //Sin variación
        else {
            return $this->stock_total;
        }
    }

    public function medidas()
    {
        return $this->hasMany(Medida::class);
    }

    public function medida_producto()
    {
        return $this->belongsToMany(Medida::class)->withPivot('stock', 'id');
    }

    public function colores()
    {
        return $this->belongsToMany(Color::class)->withPivot('stock', 'id');
    }

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function imagenes()
    {
        return $this->morphMany(Imagen::class, "imagenable");
    }

    public function ckeditors()
    {
        return $this->morphMany(Ckeditor::class, "ckeditorable");
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
