<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Cupon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CuponesController extends Controller
{
    public function index()
    {
        //$fechaActual = Carbon::now()->format('Y-m-d');
        //$cupones = Cupon::query()->where('fecha_expiracion', '>', $fechaActual)->get();
        //$cupones = Auth()->user()->cliente->cupones;

        //Muestra los cupones asignados a un cliente que son son usados y mayor de fecha actual
        $cupones = DB::table('clientes')
            ->join('cliente_cupon', 'clientes.id', '=', 'cliente_cupon.cliente_id')
            ->join('cupons', 'cliente_cupon.cupon_id', '=', 'cupons.id')
            ->select('cupons.*')
            ->where('clientes.id', Auth()->user()->cliente->id)
            ->where('cliente_cupon.uso', false)
            ->where('cupons.fecha_expiracion', '>', now())
            ->get();

        //Cupones no usados en general
        /*$cupones = DB::table('clientes')
            ->join('cliente_cupon', 'clientes.id', '=', 'cliente_cupon.cliente_id')
            ->join('cupons', 'cupons.id', '=', 'cliente_cupon.cupon_id')
            ->where('cliente_cupon.uso', false)
            ->get();*/

        //Muestra los clientes, asignados a un cupon
        /*$cupones = DB::table('clientes')
        ->join('cliente_cupon', 'clientes.id', '=', 'cliente_cupon.cliente_id')
        ->join('cupons', 'cupons.id', '=', 'cliente_cupon.cupon_id')
        ->where('clientes.id', Auth()->user()->cliente->id)
        ->get();*/


        return view('cliente.cupon.pagina-index', compact('cupones'));
    }
}
