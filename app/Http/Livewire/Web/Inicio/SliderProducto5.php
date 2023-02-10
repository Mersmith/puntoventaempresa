<?php

namespace App\Http\Livewire\Web\Inicio;

use Livewire\Component;
use App\Models\Producto;

class SliderProducto5 extends Component
{
    public $slider5 = "5";
    public $productos = [];

    public function loadProductos()
    {
        $this->productos  = Producto::orderBy('visitas', 'desc')->where('estado', 1)->limit(10)->get();

        $this->emit('gliderSliderProducto', $this->slider5);
    }

    public function render()
    {
        return view('livewire.web.inicio.slider-producto5');
    }
}
