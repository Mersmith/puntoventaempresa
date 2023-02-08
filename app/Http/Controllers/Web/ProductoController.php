<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ProductoController extends Controller
{
    public function mostrar(Producto $producto)
    {
        if (!Cookie::get('producto_visita_' . $producto->id)) {
            $producto->incrementVisitas();
            //1440 minutos (24 horas).
            //10080 minutos es igual a una semana
            //43800 minutos es igual a un mes
            Cookie::queue(Cookie::make('producto_visita_' . $producto->id, true, 1440));
        }

        return view('web.producto.producto-index', compact('producto'));
    }
}
