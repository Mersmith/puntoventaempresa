<?php

namespace App\Http\Livewire\Web\Producto;

use Livewire\Component;
use App\Models\Medida;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AgregarCarritoVariacionMedida extends Component
{
    public $producto, $medidas,  $medida_id = "";
    public $stockProducto = 0;
    public $cantidadCarrito = 1;
    public $opciones = ['color_id' => null, 'cantidad' => null];

    public function mount()
    {
        $this->medidas= $this->producto->medida_producto;

        $this->opciones["imagen"] = $this->producto->imagenes->count()  ? Storage::url($this->producto->imagenes->first()->imagen_ruta) : asset('imagenes/producto/sin_foto_producto.png');
        $this->opciones["puntos_ganar"] = $this->producto->puntos_ganar;
        $this->opciones["puntos_tope"] = $this->producto->puntos_tope;
    }

    public function updatedMedidaId($value)
    {
        $medida = $this->producto->medida_producto->find($value);
        $this->stockProducto = calculandoProductosDisponibles($this->producto->id, null, $medida->id);
        $this->opciones['medida_id'] = $medida->id;
        $this->opciones['medida'] = $medida->nombre;
        $this->opciones["cantidad"] = calculandoStockProductos($this->producto->id, null, $medida->id);
        $this->reset('cantidadCarrito');
    }

    public function disminuir()
    {
        $this->cantidadCarrito = $this->cantidadCarrito - 1;
    }

    public function aumentar()
    {
        $this->cantidadCarrito = $this->cantidadCarrito + 1;
    }

    public function agregarProducto()
    {
        //dump($this->producto->id, $this->medida_id);
        Cart::instance('shopping')->add(
            [
                'id' => $this->producto->id,
                'name' => $this->producto->nombre,
                'qty' => $this->cantidadCarrito,
                'price' => $this->producto->precio_venta,
                'weight' => 550,
                'options' => $this->opciones,
            ]
        );
        $this->stockProducto = calculandoProductosDisponibles($this->producto->id, null, $this->medida_id);

        $this->reset('cantidadCarrito');

        $this->emitTo('web.menu.menu-carrito', 'render');
    }

    public function render()
    {
        return view('livewire.web.producto.agregar-carrito-variacion-medida');
    }
}
