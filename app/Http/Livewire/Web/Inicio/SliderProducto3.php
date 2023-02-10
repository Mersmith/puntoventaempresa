<?php

namespace App\Http\Livewire\Web\Inicio;

use App\Models\Producto;
use Livewire\Component;
use App\Models\Subcategoria;

class SliderProducto3 extends Component
{
    public $slider3 = "3";
    public $productos = [];

    public function loadProductos()
    {
        $subcategoria = Subcategoria::where('nombre', "Variacion Medida")->firstOrFail();
        $this->productos  = Producto::where('subcategoria_id', $subcategoria->id)->where('estado', 1)->limit(10)->get();

        $this->emit('gliderSliderProducto', $this->slider3);
    }

    public function render()
    {
        return view('livewire.web.inicio.slider-producto3');
    }
}
