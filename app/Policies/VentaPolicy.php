<?php

namespace App\Policies;

use App\Models\Cliente;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Auth\Access\HandlesAuthorization;

class VentaPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */

    //Autor de la orden que si el genero
    public function clienteComprador(User $user, Venta $venta)
    {
        if ($venta->cliente_id == $user->cliente->id) {
            return true;
        } else {
            return false;
        }
    }

    public function clientePagador(User $user, Venta $venta)
    {
        if ($venta->estado == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function __construct()
    {
        //
    }
}
