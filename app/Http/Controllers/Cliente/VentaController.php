<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venta;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;


class VentaController extends Controller
{
    use AuthorizesRequests;

    //Mis Ordenes en total
    public function index()
    {
        $ventas = Venta::query()->where('cliente_id', auth()->user()->cliente->id);

        if (request('estado')) {
            $ventas->where('estado', request('estado'));
        }

        $ventas = $ventas->orderBy('created_at', 'desc')->paginate(5)->withQueryString();

        $pendiente = Venta::where('estado', 1)->where('cliente_id', auth()->user()->cliente->id)->count();
        $recibido = Venta::where('estado', 2)->where('cliente_id', auth()->user()->cliente->id)->count();
        $enviado = Venta::where('estado', 3)->where('cliente_id', auth()->user()->cliente->id)->count();
        $entregado = Venta::where('estado', 4)->where('cliente_id', auth()->user()->cliente->id)->count();
        $anulado = Venta::where('estado', 5)->where('cliente_id', auth()->user()->cliente->id)->count();

        return view('cliente.venta.pagina-index', compact('ventas', 'pendiente', 'recibido', 'enviado', 'entregado', 'anulado'));
    }

    //Mostrar un Orden
    public function mostrar(Venta $venta)
    {
        $this->authorize('clienteComprador', $venta);

        $envio = json_decode($venta->envio);
        $productosCarrito = json_decode($venta->contenido);

        return view('cliente.venta.pagina-mostrar', compact('venta', 'productosCarrito', 'envio'));
    }

    public function comprarPaypal(Venta $venta, Request $request)
    {
        $this->authorize('clienteComprador', $venta);

        $venta->estado = 2;
        $venta->save();
        return redirect()->route('cliente.venta.mostrar', $venta);
    }
}
