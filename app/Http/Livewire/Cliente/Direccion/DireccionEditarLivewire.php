<?php

namespace App\Http\Livewire\Cliente\Direccion;

use App\Models\Departamento;
use App\Models\Direccion;
use App\Models\Distrito;
use App\Models\Provincia;
use Livewire\Component;

class DireccionEditarLivewire extends Component
{
    public $direccion_editar;

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

    public function mount(Direccion $direccionslug)
    {
        $this->direccion_editar = $direccionslug;
        $this->nombres = $direccionslug->nombres;
        $this->celular = $direccionslug->celular;
        $this->direccion = $direccionslug->direccion;
        $this->referencia = $direccionslug->referencia;
        $this->codigo_postal = $direccionslug->codigo_postal;
        $this->departamento_id = $direccionslug->departamento_id;
        $this->departamento_nombre = $direccionslug->departamento_nombre;
        $this->provincia_id = $direccionslug->provincia_id;
        $this->provincia_nombre = $direccionslug->provincia_nombre;
        $this->distrito_id = $direccionslug->distrito_id;
        $this->distrito_nombre = $direccionslug->distrito_nombre;
        $this->departamentos = Departamento::all();
        $this->provincias = Provincia::where('departamento_id', $direccionslug->departamento_id)->get();
        $this->distritos = Distrito::where('provincia_id', $direccionslug->provincia_id)->get();
    }

    public function updatedDepartamentoId($value)
    {
        $this->provincias = Provincia::where('departamento_id', $value)->get();
        $nombre = $this->departamentos->where('id', $value)->first();
        $this->reset(['provincia_id', 'distrito_id']);
        $this->departamento_nombre = $nombre['nombre'];
    }

    public function updatedProvinciaId($value)
    {
        $this->distritos = Distrito::where('provincia_id', $value)->get();
        $nombre = $this->provincias->where('id', $value)->first();
        $this->reset('distrito_id');
        $this->provincia_nombre = $nombre['nombre'];
    }

    public function updatedDistritoId($value)
    {
        $nombre = $this->distritos->where('id', $value)->first();
        $this->distrito_nombre = $nombre['nombre'];
    }

    public function editarDireccion()
    {
        $this->validate();

        $this->direccion_editar->update([
            'nombres' => $this->nombres,
            'celular' => $this->celular,
            'direccion' => $this->direccion,
            'referencia' => $this->referencia,
            'codigo_postal' => $this->codigo_postal,
            'departamento_id' => $this->departamento_id,
            'departamento_nombre' => $this->departamento_nombre,
            'provincia_id' => $this->provincia_id,
            'provincia_nombre' => $this->provincia_nombre,
            'distrito_id' => $this->distrito_id,
            'distrito_nombre' => $this->distrito_nombre,
        ]);

        $this->emit('mensajeActualizado', "Dirección actualizado");
    }

    public function render()
    {
        return view('livewire.cliente.direccion.direccion-editar-livewire')->layout('layouts.cliente.index');
    }
}
