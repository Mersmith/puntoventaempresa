<?php

namespace App\Http\Livewire\Administrador\Cupon;

use App\Models\Cupon;
use Livewire\Component;

class CuponCrearLivewire extends Component
{
    public
        $codigo,
        $tipo = "fijo",
        $descuento,
        $carrito_monto,
        $limite = 10,
        $fecha_inicio,
        $fecha_expiracion;

    protected $validationAttributes = [
        'codigo' => 'código del cupón',
        'tipo' => 'tipo de cupón',
        'descuento' => 'descuento del cupón',
        'carrito_monto' => 'monto de carrito',
        'limite' => 'limite de uso',
        'fecha_inicio' => 'fecha de inicio',
        'fecha_expiracion' => 'fecha de expiración',
    ];

    protected $messages = [
        'codigo.required' => 'El :attribute es requerido.',
        'tipo.required' => 'El :attribute es requerido.',
        'descuento.required' => 'El :attribute es requerido.',
        'carrito_monto.required' => 'El :attribute es requerido.',
        'limite.required' => 'El :attribute es requerido.',
        'fecha_inicio.required' => 'La :attribute es requerido.',
        'fecha_expiracion.required' => 'La :attribute es requerido.',
    ];

    public function crearCupon()
    {
        $this->validate([
            'codigo' => 'required|unique:cupons',
            'tipo' => 'required',
            'descuento' => 'required|numeric',
            'carrito_monto' => 'required|numeric',
            'limite' => 'required|numeric',
            'fecha_inicio' => 'required',
            'fecha_expiracion' => 'required',
        ]);

        if ($this->fecha_expiracion > $this->fecha_inicio) {
            $cupon = new Cupon();
            $cupon->codigo = $this->codigo;
            $cupon->tipo = $this->tipo;
            $cupon->descuento = $this->descuento;
            $cupon->carrito_monto = $this->carrito_monto;
            $cupon->limite = $this->limite;
            $cupon->fecha_inicio = $this->fecha_inicio;
            $cupon->fecha_expiracion = $this->fecha_expiracion;

            $cupon->save();

            session()->flash('message', 'Cupón creado.');

            $this->emit('mensajeCreado', "Cupón creado.");

            return redirect()->route('administrador.cupon.index');
        } else {

            $this->emit('mensajeError', "La fecha de expiración debe ser mayor.");
        }
    }

    public function render()
    {
        return view('livewire.administrador.cupon.cupon-crear-livewire')->layout('layouts.administrador.index');
    }
}
