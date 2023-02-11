<?php

namespace App\Http\Livewire\Administrador\Cupon;

use App\Models\Cupon;
use Livewire\Component;
use Livewire\WithPagination;

class CuponTodoLivewire extends Component
{
    protected $listeners = ['eliminarCupon'];

    use WithPagination;
    public $buscarCupon;
    protected $paginate = 50;

    public function updatingBuscarCupon()
    {
        $this->resetPage();
    }
    
    public function eliminarCupon($cuponId)
    {
        $cupon = Cupon::find($cuponId);
        $cupon->delete();
        session()->flash('message', 'Cupon eliminado');
    }

    public function render()
    {
        //$cupones = Cupon::all();
        $cupones = Cupon::where('codigo', 'like', '%' . $this->buscarCupon . '%')->paginate(50);

        return view('livewire.administrador.cupon.cupon-todo-livewire', ['cupones' => $cupones])->layout('layouts.administrador.index');
    }
}
