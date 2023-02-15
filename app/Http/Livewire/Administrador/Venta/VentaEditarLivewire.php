<?php

namespace App\Http\Livewire\Administrador\Venta;

use App\Models\Venta;
use Livewire\Component;

class VentaEditarLivewire extends Component
{
    public $venta, $estado,  $estadoInicial;

    public function mount(Venta $venta)
    {
        $this->venta = $venta;
        $this->estado = $this->venta->estado;
        $this->estadoInicial = $this->venta->estado;
    }

    public function actualizarEstadoOrden()
    {
        $nombreEstado = "";

        if ($this->estado == 1) {
            $nombreEstado = "PENDIENTE";
        } elseif ($this->estado == 2) {
            $nombreEstado = "PAGADO";
        } elseif ($this->estado == 3) {
            $nombreEstado = "ORDENADO";
        } elseif ($this->estado == 4) {
            $nombreEstado = "ENVIADO";
        } elseif ($this->estado == 5) {
            $nombreEstado = "ENTREGADO";
        } elseif ($this->estado == 6) {
            $nombreEstado = "ANULADO";
        }

        // Obtener arreglo de eventos actual
        $eventos_actuales = json_decode($this->venta->eventos, true);

        // Crear nuevo evento y agregar al arreglo de eventos
        $evento_nuevo = ['fecha' => now()->toDateTimeString(), 'estado' => $nombreEstado];
        $eventos_actuales[] = $evento_nuevo;

        // Convertir el arreglo de eventos a formato JSON
        $eventos_json = json_encode($eventos_actuales);

        $this->venta->eventos = $eventos_json;
        $this->venta->estado = $this->estado;
        $this->venta->save();

        $this->emit('mensajeActualizado', "Estado actualizado.");
    }

    public function cancelarEstadoOrden()
    {
        $this->estado = $this->estadoInicial;
    }

    public function render()
    {
        return view('livewire.administrador.venta.venta-editar-livewire')->layout('layouts.administrador.index');
    }
}
