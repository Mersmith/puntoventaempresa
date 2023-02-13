<x-web-layout>
    @section('tituloPagina', 'Mi Orden | N° 00000-' . $venta->id)

    <div class="contenedor_pagina_carrito">
        <!--Estado producto-->
        <div class="contenedor_estado_producto">
            <div style="text-align: center">
                <h1 style="margin-bottom: 5px;">Orden: N° 00000-{{ $venta->id }} </h1>
            </div>
            <br>
            <div class="flex items-center">
                <!--Recibido-->
                <div class="relative">
                    <div class="rounded-full h-11 w-11 flex items-center justify-center"
                        style="background-color: {{ !$venta->estado == 1 || $venta->estado >= 2 ? 'rgb(245, 171, 11)' : '#9CA3AF' }}">
                        <i class="fa-solid
                        fa-dollar-sign text-white"></i>
                    </div>
                    <div class="absolute -left-1.5 mt-0.5">
                        <p>Pagado</p>
                    </div>
                </div>
                <div class="h-1 flex-1 mx-2"
                    style="background-color: {{ $venta->estado >= 2 && $venta->estado != 5 ? 'rgb(245, 171, 11)' : '#9CA3AF' }}">
                </div>
                <!--Ordenado-->
                <div class="relative">
                    <div class="rounded-full h-11 w-11 flex items-center justify-center"
                        style="background-color: {{ $venta->estado >= 2 && $venta->estado != 5 ? 'rgb(13, 235, 87)' : '#9CA3AF' }}">

                        <i class="fa-solid fa-list-check  text-white"></i>
                    </div>
                    <div class="absolute -left-1.5 mt-0.5">
                        <p>Alistado</p>
                    </div>
                </div>
                <div class="h-1 flex-1 mx-2"
                    style="background-color: {{ $venta->estado >= 3 && $venta->estado != 5 ? 'rgb(13, 235, 87)' : '#9CA3AF' }}">
                </div>
                <!--Enviado-->
                <div class="relative">
                    <div class="rounded-full h-11 w-11 flex items-center justify-center"
                        style="background-color: {{ $venta->estado >= 3 && $venta->estado != 5 ? 'rgb(13, 191, 235)' : '#9CA3AF' }}">
                        <i class="fas fa-truck text-white"></i>
                    </div>
                    <div class="absolute -left-1 mt-0.5">
                        <p>Enviado</p>
                    </div>
                </div>
                <div class="h-1 flex-1 mx-2"
                    style="background-color: {{ $venta->estado >= 4 && $venta->estado != 5 ? 'rgb(13, 191, 235)' : '#9CA3AF' }}">
                </div>
                <!--Entregado-->
                <div class="relative">
                    <div class="rounded-full h-11 w-11 flex items-center justify-center"
                        style="background-color: {{ $venta->estado >= 4 && $venta->estado != 5 ? 'rgb(223, 13, 195)' : '#9CA3AF' }}">
                        <i class="fa-solid fa-box-open text-white"></i>
                    </div>
                    <div class="absolute -left-2 mt-0.5">
                        <p>Entregado</p>
                    </div>
                </div>
            </div>
        </div>
        <!--Resumen producto-->
        <div class="contenedor_centrar_pagina">
            <!--Carrito-->
            <div class="grid_carrito_compras">
                <!--Carrito-->
                <div class="grid_elementos_carrito">
                    <!--Carrito-->
                    <div class="contenedor_carrito">
                        <h1>Resumen de Compra</h1>
                        <hr>
                        <table>
                            <thead>
                                <tr>
                                    <th>

                                    </th>
                                    <th style="text-align: left">
                                        Producto
                                    </th>
                                    <th>
                                        Precio
                                    </th>
                                    <th>
                                        Cantidad
                                    </th>
                                    <th>
                                        Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productosCarrito as $item)
                                    <tr>
                                        <td class="imagen_producto_datos_tabla">
                                            <img src="{{ $item->options->imagen }}" alt="">
                                        </td>
                                        <td class="datos_producto_datos_tabla" style="vertical-align: top;">
                                            <div>
                                                <p class="titulo_tabla_producto">{{ $item->name }}</p>
                                                <div>
                                                    @if ($item->options->color_id)
                                                        @if ($item->options->color !== 'ninguno')
                                                            <p><span>Color: </span>{{ $item->options->color }}</p>
                                                        @endif
                                                    @endif
                                                    @if ($item->options->medida_id)
                                                        <p><span>Medida: </span>{{ $item->options->medida }}</p>
                                                    @endif

                                                    <p><span>Puntos:
                                                        </span>{{ $item->options->puntos_ganar * $item->qty }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <div>
                                                <span>$ {{ number_format($item->price, 2) }}</span>
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <div>
                                                {{ $item->qty }}

                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <div>
                                                $ {{ number_format($item->price * $item->qty, 2) }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!--Contacto-->
                    <div class="contenedor_contacto">
                        <h1>Resumen de Envio</h1>
                        <hr>
                        <!--Nombre-->
                        <div class="contenedor_elemento_formulario">
                            <label>Nombre de contácto:</label>
                            <p>{{ $venta->contacto }}</p>
                        </div>
                        <!--Celular-->
                        <div class="contenedor_elemento_formulario">
                            <label>Teléfono de contácto:</label>
                            <p>{{ $venta->celular }}</p>
                        </div>
                        {{-- tipo_envio: Es una variable de alpine --}}
                        {{-- entangle: Toma la variable del livewire --}}
                        <label>Recogerá su producto en:</label>
                        <div class="contenedor_elemento_formulario">
                            @if ($venta->tipo_envio == 1)
                                <label>Departamento:</label>
                                <p>Recojo en tienda (Calle Pablo Usandizaga 683, San Borja, Lima, Perú)</p>
                            @else
                                <label>Departamento:</label>
                                <p>{{ $envio->departamento }}</p>
                                <label>Provincia:</label>
                                <p>{{ $envio->provincia }}</p>
                                <label>Distrito:</label>
                                <p>{{ $envio->distrito }}</p>
                                <label>Dirección:</label>
                                <p>{{ $envio->direccion }}</p>
                                <label>Referencia:</label>
                                <p>{{ $envio->referencia }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <!--Pago-->
                <div class="grid_metodo_pago">
                    <div class="contenedor_pago_resumen">
                        <h1>Resumen de pago</h1>
                        <hr>
                        <!--SUBTOTAL-->
                        <div class="contenedor_pago">
                            <div>SUBTOTAL: </div>
                            <div>
                                ${{ number_format($venta->total - $venta->costo_envio + (float) $venta->cupon_precio + (float) $venta->puntos_canjeados * 1.5, 2) }}
                            </div>
                        </div>
                        <!--ENVIO-->
                        <div class="contenedor_pago">
                            <div>ENVIO: </div>
                            <div>
                                @if ($venta->tipo_envio == 1)
                                    Gratis
                                @else
                                    ${{ number_format($venta->costo_envio, 2) }}
                                @endif
                            </div>
                        </div>
                        <hr>
                        <!--CUPON-->
                        @if ($venta->cupon_descuento)
                            <div class="contenedor_pago">
                                <div>Cupón: </div>
                                <div>
                                    <span>
                                        -${{ number_format($venta->cupon_precio, 2) }}
                                    </span>
                                </div>
                            </div>
                            <hr>
                        @endif
                        <!--PUNTOS-->
                        @php
                            $totalPuntosProducto = 0;
                            foreach ($productosCarrito as $producto) {
                                $totalPuntosProducto += $producto->options->puntos_ganar * $producto->qty;
                            }
                            
                        @endphp
                        @if ($venta->puntos_canjeados)
                            <div class="contenedor_pago">
                                <div>Puntos: <code>Estas ganando {{ $totalPuntosProducto }}</code></div>
                                <div>
                                    <span>
                                        -${{ number_format($venta->puntos_canjeados * config('services.crd.puntos'), 2) }}
                                    </span>
                                </div>
                            </div>
                            <hr>
                        @endif
                        <!--TOTAL-->
                        <div class="contenedor_pago" style="font-size: 20px">
                            <div>
                                <span style="font-weight: 600;">TOTAL:</span>
                            </div>
                            <div>
                                @if ($venta->puntos_canjeados)
                                    ${{ number_format($venta->total, 2) }}
                                @else
                                    ${{ number_format($venta->total + $venta->puntos_canjeados * config('services.crd.puntos'), 2) }}
                                @endif
                            </div>
                        </div>
                        <!--<div class="contenedor_boton_pagar">
                            <button class="mt-6 mb-4">Comprar</button>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-web-layout>
