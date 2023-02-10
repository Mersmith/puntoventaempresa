<?php

namespace App\Http\Livewire\Administrador\Cupon;

use App\Models\Cupon;
use Livewire\Component;

class CuponTodoLivewire extends Component
{
    //Los detectores de eventos
    protected $listeners = ['eliminarCupon'];

    public function eliminarCupon($cuponId)
    {
        $cupon = Cupon::find($cuponId);
        $cupon->delete();
        session()->flash('message', 'Cupon eliminado');
    }

    public function render()
    {
        $cupones = Cupon::all();

        return view('livewire.administrador.cupon.cupon-todo-livewire', ['cupones' => $cupones])->layout('layouts.administrador.index');
    }
}
