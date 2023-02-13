<?php

use App\Http\Controllers\Cliente\CuponesController;
use App\Http\Controllers\Cliente\PerfilController;
use App\Http\Controllers\Cliente\VentaController;
use App\Http\Livewire\Cliente\Direccion\DireccionCrearLivewire;
use App\Http\Livewire\Cliente\Direccion\DireccionEditarLivewire;
use App\Http\Livewire\Cliente\Direccion\DireccionTodoLivewire;
use App\Http\Livewire\Cliente\Favoritos\FavoritosTodoLivewire;
use App\Http\Livewire\Cliente\Perfil\PerfilLivewire;
use App\Http\Livewire\Cliente\Venta\VentaPagar;
use App\Http\Livewire\Cliente\Venta\VentaPagarLivewire;
use Illuminate\Support\Facades\Route;

Route::get('prueba-cliente', function () {
    return "Cliente";
});

Route::get('datos-personales', PerfilLivewire::class)->name('perfil');

Route::get('mis-direcciones', DireccionTodoLivewire::class)->name('direccion.index');
Route::get('crear-direccion', DireccionCrearLivewire::class)->name('direccion.crear');
Route::get('mis-direcciones/{direccion}/editar', DireccionEditarLivewire::class)->name('direccion.editar');

Route::get('puntos-crd', [PerfilController::class, 'mostrar'] )->name('puntos.index');

Route::get('mis-favoritos', FavoritosTodoLivewire::class)->name('favoritos.index');

Route::get('mis-cupones', [CuponesController::class, 'index'])->name('cupon.index');

Route::get('mi-orden/{venta}/pagar', VentaPagarLivewire::class)->name('venta.pagar');
Route::get('mis-ordenes', [VentaController::class, 'index'])->name('venta.index');
Route::get('mi-orden/{venta}', [VentaController::class, 'mostrar'])->name('venta.mostrar');
Route::get('orden/{venta}/compra-paypal', [VentaController::class, 'comprarPaypal'])->name('venta.comprar.paypal');
