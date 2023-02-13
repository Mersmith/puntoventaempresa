<?php

namespace App\Http\Livewire\Cliente\Venta;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Http;
use App\Models\Venta;
use Illuminate\Support\Facades\Auth;

class VentaPagarLivewire extends Component
{
    use AuthorizesRequests;

    public $venta;
    public $puntos_cliente;

    public function mount(Venta $venta)
    {
        $this->venta = $venta;
        $this->puntos_cliente = Auth()->user()->cliente->puntos;
    }

    public function render()
    {
        $this->authorize('clienteComprador', $this->venta);
        $this->authorize('clientePagador', $this->venta);

        $envio = json_decode($this->venta->envio);
        $productosCarrito = json_decode($this->venta->contenido);

        return view('livewire.cliente.venta.venta-pagar-livewire', compact('productosCarrito', 'envio'))->layout('layouts.web.index');
    }
}
