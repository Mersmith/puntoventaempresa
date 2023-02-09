<?php

use App\Http\Controllers\Cliente\PerfilController;
use App\Http\Livewire\Cliente\Direccion\DireccionCrearLivewire;
use App\Http\Livewire\Cliente\Direccion\DireccionEditarLivewire;
use App\Http\Livewire\Cliente\Direccion\DireccionTodoLivewire;
use App\Http\Livewire\Cliente\Favoritos\FavoritosTodoLivewire;
use App\Http\Livewire\Cliente\Perfil\PerfilLivewire;
use Illuminate\Support\Facades\Route;

Route::get('prueba-cliente', function () {
    return "Cliente";
});

Route::get('datos-personales', PerfilLivewire::class)->name('perfil');

Route::get('mis-direcciones', DireccionTodoLivewire::class)->name('direccion.index');
Route::get('crear-direccion', DireccionCrearLivewire::class)->name('direccion.crear');
Route::get('mis-direcciones/{direccionslug}/editar', DireccionEditarLivewire::class)->name('direccion.editar');

Route::get('puntos-crd', [PerfilController::class, 'mostrar'] )->name('puntos.index');

Route::get('mis-favoritos', FavoritosTodoLivewire::class)->name('favoritos.index');
