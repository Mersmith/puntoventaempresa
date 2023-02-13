<?php

namespace App\Http\Livewire\Cliente\Venta;

use Livewire\Component;

class VentaEstado extends Component
{
    public $ventaEstado, $estado, $estadoInicial;

    public function actualizarEstadoVenta()
    {
        if ($this->ventaEstado->estado != 5) {
            $this->ventaEstado->estado = 5;
            $this->ventaEstado->save();
            $this->emit('mensajeActualizado', "Compra cancelada.");
        } else {
            $this->ventaEstado->estado = 1;
            $this->ventaEstado->save();
            $this->emit('mensajeActualizado', "Estado actualizado para comprar.");
        }
    }

    public function render()
    {
        return view('livewire.cliente.venta.venta-estado');
    }
}
