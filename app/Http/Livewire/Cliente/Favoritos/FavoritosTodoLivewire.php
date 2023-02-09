<?php

namespace App\Http\Livewire\Cliente\Favoritos;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class FavoritosTodoLivewire extends Component
{
    public function eliminarFavorito($rowId)
    {
        dump($rowId);
        /*Cart::instance('wishlist')->remove($rowId);

        $this->emitTo('web.menu.menu-favorito', 'render');*/
    }

    public function render()
    {
        return view('livewire.cliente.favoritos.favoritos-todo-livewire')->layout('layouts.cliente.index');
    }
}
