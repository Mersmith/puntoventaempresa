<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function mostrar()
    {
        return view('cliente.puntos.pagina-index');
    }
}
