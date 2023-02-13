<?php

namespace App\Http\Livewire\Cliente\Direccion;

use Livewire\Component;
use App\Models\Direccion;

class DireccionTodoLivewire extends Component
{
    public $direcciones;

    protected $listeners = ['eliminarDireccion'];

    public function mount()
    {
        $this->traerDirecciones();
    }

    public function traerDirecciones()
    {
        //$this->direcciones = auth()->user()->cliente->direcciones;
        //$this->direcciones = Direccion::where('cliente_id', auth()->user()->cliente->id)->orderBy('updated_at', 'asc')->get();
        $this->direcciones = Direccion::where('cliente_id', auth()->user()->cliente->id)->orderBy('updated_at', 'desc')->get();
    }

    public function establecerPrincipal(Direccion $direccion)
    {
        if ($direccion->posicion == 0) {
            $direccion->posicion = 1;
        } else {
            $direccion->posicion = 0;
        }
        $direccion->save();
        $this->traerDirecciones();
        $this->emit('mensajeActualizado', "Dirección actualizado");
    }

    public function eliminarDireccion(Direccion $direccion)
    {
        $direccion->delete();
        $this->traerDirecciones();
    }

    public function render()
    {
        return view('livewire.cliente.direccion.direccion-todo-livewire')->layout('layouts.cliente.index');
    }
}
