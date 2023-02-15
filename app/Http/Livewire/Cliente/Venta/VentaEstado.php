<?php

namespace App\Http\Livewire\Cliente\Venta;

use Livewire\Component;

class VentaEstado extends Component
{
    public $ventaEstado, $estado, $estadoInicial;

    public function actualizarEstadoVenta()
    {
        if ($this->ventaEstado->estado != 5) {
            // Obtener arreglo de eventos actual
            $eventos_actuales = json_decode($this->ventaEstado->eventos, true);

            // Crear nuevo evento y agregar al arreglo de eventos
            $evento_nuevo = ['fecha' => now()->toDateTimeString(), 'estado' => 'ANULADO'];
            $eventos_actuales[] = $evento_nuevo;

            // Convertir el arreglo de eventos a formato JSON
            $eventos_json = json_encode($eventos_actuales);

            $this->ventaEstado->eventos = $eventos_json;
            $this->ventaEstado->estado = 5;
            $this->ventaEstado->save();
            $this->emit('mensajeActualizado', "Compra cancelada.");
        } else {
            // Obtener arreglo de eventos actual
            $eventos_actuales = json_decode($this->ventaEstado->eventos, true);

            // Crear nuevo evento y agregar al arreglo de eventos
            $evento_nuevo = ['fecha' => now()->toDateTimeString(), 'estado' => 'PENDIENTE'];
            $eventos_actuales[] = $evento_nuevo;

            // Convertir el arreglo de eventos a formato JSON
            $eventos_json = json_encode($eventos_actuales);

            $this->ventaEstado->eventos = $eventos_json;
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
