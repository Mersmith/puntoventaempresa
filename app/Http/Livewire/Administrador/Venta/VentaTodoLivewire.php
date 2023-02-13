<?php

namespace App\Http\Livewire\Administrador\Venta;

use App\Models\Venta;
use Livewire\Component;
use Livewire\WithPagination;

class VentaTodoLivewire extends Component
{
    use WithPagination;
    public $buscarOrden;
    protected $paginate = 10;

    public $estado;
    protected $queryString = ['estado'];

    public function render()
    {
        $ordenes = Venta::query()->orderBy('updated_at', 'desc');

        if ($this->estado) {
            $ordenes->where('estado', $this->estado);
            if ($this->buscarOrden) {
                $ordenes->where('total', 'like', '%' . $this->buscarOrden . '%');
            }
        } else {
            if ($this->buscarOrden) {
                $ordenes->where('total', 'like', '%' . $this->buscarOrden . '%');
            }
        }

        $ordenes = $ordenes->paginate(4)->withQueryString();

        $pendiente = Venta::where('estado', 1)->count();
        $recibido = Venta::where('estado', 2)->count();
        $enviado = Venta::where('estado', 3)->count();
        $entregado = Venta::where('estado', 4)->count();
        $anulado = Venta::where('estado', 5)->count();
        $todos = $pendiente + $recibido + $enviado + $entregado + $anulado;

        return view('livewire.administrador.venta.venta-todo-livewire', compact('ordenes', 'pendiente', 'recibido', 'enviado', 'entregado', 'anulado', 'todos'))->layout('layouts.administrador.index');
    }
}
