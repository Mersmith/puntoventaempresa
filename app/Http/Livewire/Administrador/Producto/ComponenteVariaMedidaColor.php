<?php

namespace App\Http\Livewire\Administrador\Producto;

use Livewire\Component;
use App\Models\Medida;

class ComponenteVariaMedidaColor extends Component
{
    protected $listeners = ['eliminarMedidaColorVariacion'];

    //Crear
    public $producto, $nombre;

    //Editar
    public $medida, $nombre_editado;

    public $abierto = false;

    protected $validationAttributes = [
        'nombre' => 'nombre',
        'nombre_editado' => 'nombre',
    ];

    protected $messages = [
        'nombre.required' => 'El :attribute es requerido.',
        'nombre_editado.required' => 'El :attribute es requerido.',
    ];

    public function guardarMedida()
    {
        $rules = [
            'nombre' => 'required'
        ];

        $this->validate($rules);

        $medida = Medida::where('producto_id', $this->producto->id)
            ->where('nombre', $this->nombre)
            ->first();

        if ($medida) {
            $this->emit('mensajeError', 'Existe.');
        } else {
            $this->producto->medidas()->create([
                'nombre' => $this->nombre
            ]);
            $this->emit('mensajeCreado', "Creado.");
        }

        $this->reset('nombre');

        $this->producto = $this->producto->fresh();
    }

    public function editarMedida(Medida $medida)
    {
        $this->abierto = true;
        $this->medida = $medida;
        $this->nombre_editado = $medida->nombre;
    }

    public function actualizarMedida()
    {
        $rules = [
            'nombre_editado' => 'required'
        ];

        $this->validate($rules);

        $this->medida->nombre = $this->nombre_editado;
        $this->medida->save();

        $this->emit('mensajeEditado', "Actualizado.");

        $this->producto = $this->producto->fresh();

        $this->abierto = false;
    }

    public function eliminarMedidaColorVariacion(Medida $medida)
    {
        $medida->delete();
        $this->producto = $this->producto->fresh();
        $this->emit('mensajeEliminado', "Eliminado.");
    }

    public function render()
    {
        $producto_medidas = $this->producto->medidas;

        return view('livewire.administrador.producto.componente-varia-medida-color', compact('producto_medidas'));
    }
}
