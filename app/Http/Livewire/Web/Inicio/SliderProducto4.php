<?php

namespace App\Http\Livewire\Web\Inicio;

use Livewire\Component;
use App\Models\Producto;

class SliderProducto4 extends Component
{
    public $slider4 = "4";
    public $productos = [];

    public function loadProductos()
    {
        $this->productos  = Producto::orderBy('precio_venta', 'asc')->where('estado', 1)->limit(10)->get();

        $this->emit('gliderSliderProducto', $this->slider4);
    }

    public function render()
    {
        return view('livewire.web.inicio.slider-producto4');
    }
}
