<?php

namespace App\Http\Livewire\Cliente\Favoritos;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class FavoritosTodoLivewire extends Component
{
    protected $listeners = ['render'];

    public function eliminarFavorito($rowId)
    {      
        Cart::instance('wishlist')->remove($rowId);

        $this->emitTo('web.menu.menu-favorito', 'render');
        $this->emitTo('cliente.favoritos.favoritos-todo-livewire', 'render');
    }

    public function render()
    {
        return view('livewire.cliente.favoritos.favoritos-todo-livewire')->layout('layouts.cliente.index');
    }
}
