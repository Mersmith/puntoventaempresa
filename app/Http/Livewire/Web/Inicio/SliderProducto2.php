<?php

namespace App\Http\Livewire\Web\Inicio;

use Livewire\Component;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Builder;

class SliderProducto2 extends Component
{
    public $slider2 = "2";
    public $productos = [];

    public function loadProductos()
    {
        $productosQuery = Producto::query();

        $productosQuery = $productosQuery->whereHas('subcategoria.categoria', function (Builder $query) {
            $query->where('nombre', "Equipos Extraorales");
        });

        $this->productos = $productosQuery->where('estado', 1)->limit(10)->get();

        $this->emit('gliderSliderProducto', $this->slider2);
    }

    public function render()
    {
        return view('livewire.web.inicio.slider-producto2');
    }
}
