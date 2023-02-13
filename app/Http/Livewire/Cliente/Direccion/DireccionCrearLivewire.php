<?php

namespace App\Http\Livewire\Cliente\Direccion;

use App\Models\Departamento;
use App\Models\Direccion;
use App\Models\Distrito;
use App\Models\Provincia;
use Livewire\Component;

class DireccionCrearLivewire extends Component
{
    public $departamentos, $provincias = [], $distritos = [];

    public $nombres = "", $celular = "", $direccion = "", $referencia = "", $codigo_postal = "";
    public $departamento_id = "", $provincia_id = "", $distrito_id = "";
    public $departamento_nombre = "", $provincia_nombre = "", $distrito_nombre = "";

    protected $rules = [
        'nombres' => 'required',
        'celular' => 'required',
        'direccion' => 'required',
        'referencia' => 'required',
        'codigo_postal' => 'required',
        'departamento_id' => 'required',
        'provincia_id' => 'required',
        'distrito_id' => 'required',
        'departamento_nombre' => 'required',
        'provincia_nombre' => 'required',
        'distrito_nombre' => 'required',
    ];

    protected $messages = [
        'nombres' => 'El nombre completo es requerido.',
        'celular' => 'El celular es requerido.',
        'direccion' => 'La direccion es requerida.',
        'referencia' => 'La referencia es requerida.',
        'codigo_postal' => 'El código postal es requerido.',
        'departamento_id' => 'El departamento es requerido.',
        'provincia_id' => 'La provincia es requerida.',
        'distrito_id' => 'El distrito es requerido.',
    ];

    public function mount()
    {
        $this->departamentos = Departamento::all();
    }

    public function updatedDepartamentoId($value)
    {
        $this->provincias = Provincia::where('departamento_id', json_decode($value)->id)->get();
        $this->reset(['provincia_id', 'distrito_id']);
        $this->departamento_nombre = json_decode($value)->nombre;
    }

    public function updatedProvinciaId($value)
    {
        $this->distritos = Distrito::where('provincia_id', json_decode($value)->id)->get();
        $this->reset('distrito_id');
        $this->provincia_nombre = json_decode($value)->nombre;
    }

    public function updatedDistritoId($value)
    {
        $this->distrito_nombre = json_decode($value)->nombre;
    }

    public function creaDireccion()
    {
        $this->validate();

        $direccion = new Direccion();

        $direccion->cliente_id = auth()->user()->cliente->id;
        $direccion->nombres = $this->nombres;
        $direccion->celular = $this->celular;
        $direccion->direccion = $this->direccion;
        $direccion->referencia = $this->referencia;
        $direccion->codigo_postal = $this->codigo_postal;

        $direccion->departamento_id = json_decode($this->departamento_id)->id;
        $direccion->departamento_nombre = $this->departamento_nombre;
        $direccion->provincia_id = json_decode($this->provincia_id)->id;
        $direccion->provincia_nombre = $this->provincia_nombre;
        $direccion->distrito_id = json_decode($this->distrito_id)->id;
        $direccion->distrito_nombre = $this->distrito_nombre;

        $direccion->save();
        return redirect()->route('cliente.direccion.index');
    }
    public function render()
    {
        return view('livewire.cliente.direccion.direccion-crear-livewire')->layout('layouts.cliente.index');
    }
}
