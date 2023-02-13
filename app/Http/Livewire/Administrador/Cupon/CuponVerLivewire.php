<?php

namespace App\Http\Livewire\Administrador\Cupon;

use App\Models\Cliente;
use App\Models\ClienteCupon;
use App\Models\Cupon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CuponVerLivewire extends Component
{
    protected $listeners = ['render', 'eliminarAsignacion'];

    public $cupon;
    public $clientes;
    public $cliente_id = "";

    public $abierto = false, $cliente_cupon, $estado_cupon;

    protected $validationAttributes = [
        'cliente_id' => 'cliente',
    ];

    protected $messages = [
        'cliente_id.required' => 'El :attribute es requerido.',
    ];

    public function mount(Cupon $cupon)
    {
        $this->cupon = $cupon;
        $this->clientes = Cliente::all();
    }

    public function asignarCupon()
    {
        $this->validate([
            'cliente_id' => 'required',
        ]);

        $cliente = Cliente::find($this->cliente_id);

        $cuponesAsignados = $cliente->cupones->pluck('id')->toArray();

        if (!in_array($this->cupon->id, $cuponesAsignados)) {

            $cliente->cupones()->attach($this->cupon->id);

            $this->emit('mensajeCreado', "Agregado.");

            $this->emitTo('administrador.cupon.cupon-ver-livewire', 'render');
        } else {

            $this->emit('mensajeError', "Ya estaba agregado.");
        }
    }

    public function asignarCuponVarios()
    {
        $clientes = Cliente::all();

        foreach ($clientes as $cliente) {

            $cuponesAsignados = $cliente->cupones->pluck('id')->toArray();

            if (!in_array($this->cupon->id, $cuponesAsignados)) {

                $cliente->cupones()->attach($this->cupon->id);

                $this->emit('mensajeCreado', "Agregado.");

                $this->emitTo('administrador.cupon.cupon-ver-livewire', 'render');
            }
        }

        $this->emit('mensajeCreado', "Agregados.");
    }

    public function editarAsignacion(ClienteCupon $clienteCupon)
    {
        $this->resetValidation();

        $this->cliente_cupon = $clienteCupon;
        $this->estado_cupon = $clienteCupon->uso;
        $this->abierto = true;
    }

    public function actualizarAsignacion()
    {
        $this->cliente_cupon->update(
            [
                'uso' => $this->estado_cupon,
            ]
        );

        $this->reset('abierto', 'cliente_cupon', 'estado_cupon');

        $this->emit('mensajeActualizado', "Editado.");

        $this->emitTo('administrador.cupon.cupon-ver-livewire', 'render');
    }


    public function eliminarAsignacion(Cliente $cliente)
    {
        DB::table('cliente_cupon')->where([
            ['cliente_id', '=', $cliente->id],
            ['cupon_id', '=', $this->cupon->id]
        ])->delete();

        //$this->emit('mensajeEliminado', "Eliminado.");

        $this->emitTo('administrador.cupon.cupon-ver-livewire', 'render');
    }

    public function render()
    {
        $asignados = $this->cupon->clientesCupones;

        return view('livewire.administrador.cupon.cupon-ver-livewire', compact('asignados'))->layout('layouts.administrador.index');
    }
}
