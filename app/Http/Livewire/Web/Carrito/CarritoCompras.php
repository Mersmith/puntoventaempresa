<?php

namespace App\Http\Livewire\Web\Carrito;

use App\Models\Cupon;
use App\Models\Departamento;
use Livewire\Component;
use App\Models\Provincia;
use App\Models\Distrito;
use App\Models\Venta;
use Gloudemans\Shoppingcart\Facades\Cart;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class CarritoCompras extends Component
{
    protected $listeners = ['render'];

    public $tipo_envio = 1;
    public $contacto, $celular, $direccion, $referencia, $costo_envio = 0;
    public $departamentos, $provincias = [], $distritos = [];
    public $departamento_id = "", $provincia_id = "", $distrito_id = "";
    public $codigo_cupon, $tipoCupon = "fijo", $tieneCodigoCupon = 0, $cupon_descuento = 0;

    public $tienePuntos = 0, $puntosCanje = 0, $puntos_descuento = 0;

    public $puntos_cliente;

    public $rules = [
        'contacto' => 'required',
        'celular' => 'required',
        'tipo_envio' => 'required'
    ];

    protected $messages = [
        'contacto.required' => 'Nombre de contacto requerido.',
        'celular.required' => 'Celular de contacto requerido.',
        'departamento_id.required' => 'Departamento de envio requerido.',
        'provincia_id.required' => 'Provincia de envio requerido.',
        'distrito_id.required' => 'Distrito de envio requerido.',
        'direccion.required' => 'Dirección de envio requerido.',
        'referencia.required' => 'Referencia de envio requerido.',
    ];

    public function mount()
    {
        $this->departamentos = Departamento::all();
        $this->contacto = auth()->user()->cliente->nombre . ' ' . auth()->user()->cliente->apellido;
        $this->celular = auth()->user()->cliente->celular;
    }

    public function updatedTipoEnvio($value)
    {
        if ($value == 1) {
            $this->resetValidation([
                'departamento_id', 'provincia_id', 'distrito_id', 'direccion', 'referencia'
            ]);
        }
    }

    public function updatedDepartamentoId($value)
    {
        $this->provincias = Provincia::where('departamento_id', $value)->get();
        $this->reset(['provincia_id', 'distrito_id']);
    }

    public function updatedProvinciaId($value)
    {
        $provincia = Provincia::find($value);
        $this->costo_envio = $provincia->costo;
        $this->distritos = Distrito::where('provincia_id', $value)->get();
        $this->reset('distrito_id');
    }

    public function eliminarCarritoCompras()
    {
        Cart::instance('shopping')->destroy();
        $this->emitTo('frontend.menu.menu-carrito', 'render');
    }

    public function eliminarProducto($rowId)
    {
        Cart::instance('shopping')->remove($rowId);
        $this->emitTo('frontend.menu.menu-carrito', 'render');
    }

    public function aplicarCodigoCupon()
    {
        $cupon = Cupon::where('codigo', $this->codigo_cupon)->where('fecha_expiracion', '>=', Carbon::today())->where('carrito_monto', '<=', Cart::instance('shopping')->subtotal(2, '.', ''))->first();
        if (!$cupon) {
            //session()->flash('cupon_mensaje', 'Cupon invalido');
            $this->emit('mensajeEliminado', "Cupón inválido.");
            return;
        } else {
            //session()->flash('cupon_mensaje', 'Cupon valido');
            $this->emit('mensajeCreado', "Cupón activado.");
            $this->cupon_descuento = $cupon->descuento;
            $this->tipoCupon = $cupon->tipo;
        }
    }

    public function eliminarCupon()
    {
        $this->cupon_descuento = 0;
        $this->tieneCodigoCupon = 0;
    }

    public function aplicarPuntos()
    {
        $puntosEntero = (int)$this->puntosCanje;
        if ($puntosEntero <= $this->puntos_cliente) {
            //session()->flash('puntos_mensaje', 'Puntos validos');
            $this->emit('mensajeCreado', "Puntos activado.");
            //1 punto = 1.5 soles
            //5 puntos = 5*1.5 soles = 7.5 soles
            $this->puntos_descuento = $puntosEntero * config('services.crd.puntos');
        } else {
            //session()->flash('puntos_mensaje', 'Puntos invalidos');
            $this->emit('mensajeEliminado', "Puntos inválido.");
            return;
        }
    }

    public function eliminarPuntos()
    {
        $this->puntos_descuento = 0;
        $this->tienePuntos = 0;
    }

    public function crearOrden()
    {
        $rules = $this->rules;

        if ($this->tipo_envio == 2) {
            $rules['departamento_id'] = 'required';
            $rules['provincia_id'] = 'required';
            $rules['distrito_id'] = 'required';
            $rules['direccion'] = 'required';
            $rules['referencia'] = 'required';
        }

        $this->validate($rules);

        $orden = new Venta();

        $orden->user_id = auth()->user()->id;
        $orden->contacto = $this->contacto;
        $orden->celular = $this->celular;
        $orden->tipo_envio = $this->tipo_envio;
        $orden->costo_envio = 0;
        $orden->total = $this->costo_envio + Cart::instance('shopping')->subtotal(2, '.', '') - (float)$this->cupon_descuento - (float)$this->puntos_descuento;
        $orden->contenido = Cart::instance('shopping')->content();
        $orden->cupon_descuento = $this->codigo_cupon;
        $orden->cupon_precio = $this->cupon_descuento;
        $orden->puntos_canjeados = $this->puntosCanje;

        if ($this->tipo_envio == 2) {
            $orden->costo_envio = $this->costo_envio;
            $orden->envio = json_encode([
                'departamento' => Departamento::find($this->departamento_id)->nombre,
                'provincia' => Provincia::find($this->provincia_id)->nombre,
                'distrito' => Distrito::find($this->distrito_id)->nombre,
                'direccion' => $this->direccion,
                'referencia' => $this->referencia
            ]);
        }

        $orden->save();

        foreach (Cart::instance('shopping')->content() as $item) {
            stockActualizar($item);
        }

        Cart::instance('shopping')->destroy();

        return redirect()->route('cliente.orden.pagar', $orden);
    }

    public function render()
    {
        return view('livewire.web.carrito.carrito-compras')->layout('layouts.web.index');
    }
}
