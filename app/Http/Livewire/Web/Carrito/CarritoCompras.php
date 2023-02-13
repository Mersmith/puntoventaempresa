<?php

namespace App\Http\Livewire\Web\Carrito;

use App\Models\ClienteCupon;
use App\Models\Cupon;
use App\Models\Departamento;
use App\Models\Direccion;
use Livewire\Component;
use App\Models\Provincia;
use App\Models\Distrito;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\VentaDetalle;
use Gloudemans\Shoppingcart\Facades\Cart;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CarritoCompras extends Component
{
    protected $listeners = ['render'];

    public $tipo_envio = 1;

    public $direccion_principal, $costo_envio = 0, $observacion_envio;

    public $cuponFormulario = [
        'cupon' => null,
        'cupon_id' => null,
        'cupon_codigo' => null,
        'cupon_tipo' => "fijo",
        'cupon_descuento' => 0,
        'cupon_tiene' => 0,
    ];

    public $puntosFormulario = [
        'puntos_canje' => 0,
        'puntos_dinero' => 0,
        'puntos_tiene' => 0,
    ];

    public $rules = [
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
        $this->direccion_principal = Direccion::where('cliente_id', auth()->user()->cliente->id)->orderBy('updated_at', 'desc')->first();
        $this->costo_envio = Provincia::find($this->direccion_principal->provincia_id)->costo;
    }

    public function updatedTipoEnvio($value)
    {
        if ($value == 1) {
            $this->resetValidation([
                'departamento_id', 'provincia_id', 'distrito_id', 'direccion', 'referencia'
            ]);
        }
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
        $cupon = Cupon::where('codigo', $this->cuponFormulario['cupon_codigo'])->where('fecha_expiracion', '>=', Carbon::today())->where('carrito_monto', '<=', Cart::instance('shopping')->subtotal(2, '.', ''))->first();

        if (!$cupon) {
            //session()->flash('cupon_mensaje', 'Cupon invalido');
            $this->emit('mensajeEliminado', "El cupón invalido.");
            $this->reset('cuponFormulario');
            return;
        } else {
            if ($cupon->usado <= $cupon->limite) {
                $cuponesAsignados = auth()->user()->cliente->cupones->pluck('id')->toArray();

                if (!in_array($cupon->id, $cuponesAsignados)) {
                    $this->emit('mensajeEliminado', "No tienes asignado este cupón.");
                    $this->reset('cuponFormulario');
                } else {

                    //session()->flash('cupon_mensaje', 'Cupon valido');
                    $this->cuponFormulario['cupon'] = $cupon;
                    $this->cuponFormulario['cupon_id'] = $cupon->id;
                    $this->cuponFormulario['cupon_codigo'] = $cupon->codigo;
                    $this->cuponFormulario['cupon_tipo'] = $cupon->tipo;
                    $this->cuponFormulario['cupon_descuento'] = $cupon->descuento;

                    $this->emit('mensajeCreado', "Cupón activado.");
                }
            } else {
                $this->emit('mensajeEliminado', "El cupón ha alcanzado su límite de usos.");
            }
        }
    }

    public function eliminarCupon()
    {
        $this->reset('cuponFormulario');
    }

    public function aplicarPuntos()
    {
        $puntosEntero = (int)$this->puntosFormulario['puntos_canje'];

        if ($puntosEntero <= auth()->user()->cliente->puntos) {

            if ($puntosEntero * config('services.crd.puntos') > Cart::instance('shopping')->subtotal(2, '.', '')) {
                $this->reset('puntosFormulario');
                $this->emit('mensajeEliminado', "Puntos exceden a la monto de compra.");
                return;
            } else {
                //session()->flash('puntos_mensaje', 'Puntos validos');
                //1 punto = 1.5 soles
                //5 puntos = 5*1.5 soles = 7.5 soles
                $this->puntosFormulario['puntos_dinero'] = $puntosEntero * config('services.crd.puntos');
                $this->emit('mensajeCreado', "Puntos activado.");
            }
        } else {
            //session()->flash('puntos_mensaje', 'Puntos invalidos');
            $this->reset('puntosFormulario');
            $this->emit('mensajeEliminado', "Puntos insuficiente.");
            return;
        }
    }

    public function eliminarPuntos()
    {
        $this->reset('puntosFormulario');
    }

    public function crearOrden()
    {
        $this->validate();

        $productosCarrito = json_decode(Cart::instance('shopping')->content(), true);
        $totalPuntosProducto = 0;

        foreach ($productosCarrito as $producto) {
            $opciones = $producto['options'];
            $totalPuntosProducto += $opciones['puntos_ganar'] * $producto['qty'];
        }

        $envio = null;
        $precio_envio = $this->costo_envio;
        $direccion_id = null;

        if ($this->tipo_envio == 2) {
            $envioJson = json_encode([
                'departamento' => $this->direccion_principal->departamento_nombre,
                'provincia' => $this->direccion_principal->provincia_nombre,
                'distrito' => $this->direccion_principal->distrito_nombre,
                'direccion' => $this->direccion_principal->direccion,
                'referencia' => $this->direccion_principal->referencia,
            ]);
            $envio = $envioJson;
            $direccion_id = $this->direccion_principal->id;
        } else {
            $precio_envio = 0;
        }

        // Inicio de la transacción
        DB::beginTransaction();

        try {
            // Creación de la venta
            $venta = Venta::create([
                'cliente_id' => auth()->user()->cliente->id,
                'direccion_id' => $direccion_id,
                'total' => $this->costo_envio + Cart::instance('shopping')->subtotal(2, '.', '') - (float)$this->cuponFormulario['cupon_descuento'] - (float)$this->puntosFormulario['puntos_dinero'],
                'contenido' => Cart::instance('shopping')->content(),
                'tipo_envio' => $this->tipo_envio,
                'envio' => $envio,
                'costo_envio' => $precio_envio,
                'puntos_usados' => $this->puntosFormulario['puntos_canje'],
                'puntos_ganados' => $totalPuntosProducto,
                'puntos_dinero' => $this->puntosFormulario['puntos_dinero'],
                'observacion' => $this->observacion_envio,
            ]);

            // Verificación de cupón y asignación a la venta
            if ($this->cuponFormulario['cupon']) {
                $cupon = Cupon::where('codigo', $this->cuponFormulario['cupon_codigo'])->first();

                $venta->cupon_id = $this->cuponFormulario['cupon_id'];
                $venta->cupon_codigo = $this->cuponFormulario['cupon_codigo'];
                $venta->cupon_tipo = $this->cuponFormulario['cupon_tipo'];
                $venta->cupon_descuento = $this->cuponFormulario['cupon_descuento'];
                $venta->save();

                // Aumentar la cantidad de uso
                if ($cupon->usado <= $cupon->limite) {
                    $cupon->usado = $cupon->usado + 1;
                    $cupon->save();
                }

                // Cambiar estado de uso
                $clienteCupon = ClienteCupon::where('cliente_id', auth()->user()->cliente->id)
                    ->where('cupon_id', $this->cuponFormulario['cupon_id'])
                    ->first();
                $clienteCupon->uso = 1;
                $clienteCupon->save();
            }

            // Creación de los detalles de venta
            foreach (Cart::instance('shopping')->content() as $item) {
                VentaDetalle::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $item->id,
                    'cantidad' => $item->qty,
                    //'price' => Producto::find($item->id)->precio_venta
                    'precio' => $item->price,
                    'contenido' => $item->options,
                ]);
            }

            // Confirmación de la transacción
            DB::commit();

            $this->emit('mensajeCreado', "Orden generada.");

            foreach (Cart::instance('shopping')->content() as $item) {
                stockActualizar($item);
            }

            Cart::instance('shopping')->destroy();

            $this->emitTo('web.menu.menu-carrito', 'render');

            //return redirect()->route('cliente.orden.pagar', $venta);

            // Retorno de la respuesta
            //return response()->json([
            //    'message' => 'Venta registrada con éxito'
            //], 201);

        } catch (\Exception $e) {

            // Deshacer la transacción
            DB::rollback();

            $this->emit('mensajeEliminado', "Error en la compra vuelve a intentarlo.");

            // Retorno de la respuesta con error
            //return response()->json([
            //    'message' => 'Error al registrar la venta'
            //], 500);
        }
    }

    public function render()
    {
        return view('livewire.web.carrito.carrito-compras')->layout('layouts.web.index');
    }
}
