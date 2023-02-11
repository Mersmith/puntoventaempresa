<?php

namespace App\Http\Livewire\Web\Carrito;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class ActualizarCantidadVariacionColor extends Component
{
    public $rowId, $cantidadCarrito, $stockProducto, $cantidadProducto;

    //mount palabra reservada, al cargar la página.
    public function mount()
    {
        $itemCarrito = Cart::instance('shopping')->get($this->rowId);
        $this->cantidadCarrito = $itemCarrito->qty;
        //$color = Color::where('nombre', $itemCarrito->options->color)->first();
        //$this->stockProducto = calculandoProductosDisponibles($itemCarrito->id, $color->id);
    }

    public function disminuir()
    {
        $this->cantidadCarrito = $this->cantidadCarrito - 1;

        Cart::instance('shopping')->update($this->rowId, $this->cantidadCarrito);

        //Emite el render al CarritoCompras
        $this->emit('render');
    }

    public function aumentar()
    {
        $this->cantidadCarrito = $this->cantidadCarrito + 1;

        Cart::instance('shopping')->update($this->rowId, $this->cantidadCarrito);

        //Emite el render al CarritoCompras
        $this->emit('render');
    }

    public function render()
    {
        return view('livewire.web.carrito.actualizar-cantidad-variacion-color');
    }
}
