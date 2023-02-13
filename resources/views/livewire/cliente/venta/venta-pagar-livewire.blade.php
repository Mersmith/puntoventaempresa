<div>
    @section('tituloPagina', 'Pagar Mi Orden | N° 00000-' . $venta->id)

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
                    <div
                        class="{{ !$venta->estado == 1 || $venta->estado >= 2 ? 'bg-blue-400' : 'bg-gray-400' }}  rounded-full h-11 w-11 flex items-center justify-center">
                        <i class="fa-solid fa-dollar-sign text-white"></i>
                    </div>
                    <div class="absolute -left-1.5 mt-0.5">
                        <p>Pagado</p>
                    </div>
                </div>
                <div
                    class="{{ $venta->estado >= 2 && $venta->estado != 5 ? 'bg-blue-400' : 'bg-gray-400' }} h-1 flex-1 mx-2">
                </div>
                <!--Ordenado-->
                <div class="relative">
                    <div
                        class="{{ $venta->estado >= 2 && $venta->estado != 5 ? 'bg-blue-400' : 'bg-gray-400' }}  rounded-full h-11 w-11 flex items-center justify-center">
                        <i class="fa-solid fa-list-check  text-white"></i>
                    </div>
                    <div class="absolute -left-1.5 mt-0.5">
                        <p>Alistado</p>
                    </div>
                </div>
                <div
                    class="{{ $venta->estado >= 3 && $venta->estado != 5 ? 'bg-blue-400' : 'bg-gray-400' }} h-1 flex-1 mx-2">
                </div>
                <!--Enviado-->
                <div class="relative">
                    <div
                        class="{{ $venta->estado >= 3 && $venta->estado != 5 ? 'bg-blue-400' : 'bg-gray-400' }} rounded-full h-11 w-11 flex items-center justify-center">
                        <i class="fas fa-truck text-white"></i>
                    </div>
                    <div class="absolute -left-1 mt-0.5">
                        <p>Enviado</p>
                    </div>
                </div>
                <div
                    class="{{ $venta->estado >= 4 && $venta->estado != 5 ? 'bg-blue-400' : 'bg-gray-400' }} h-1 flex-1 mx-2">
                </div>
                <!--Entregado-->
                <div class="relative">
                    <div
                        class="{{ $venta->estado >= 4 && $venta->estado != 5 ? 'bg-blue-400' : 'bg-gray-400' }} rounded-full h-11 w-11 flex items-center justify-center">
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
                                ${{ number_format($venta->total - $venta->costo_envio + (float) $venta->cupon_descuento + (float) $venta->puntos_usados * config('services.crd.puntos'), 2) }}
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
                                        -${{ number_format($venta->cupon_descuento, 2) }}
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
                        @if ($venta->puntos_usados <= $puntos_cliente)
                            @if ($venta->puntos_usados)
                                <div class="contenedor_pago">
                                    <div>Puntos: <code>Estas ganando {{ $totalPuntosProducto }} puntos</code></div>
                                    <div style="
                                    text-align: end;
                                ">
                                        <span>
                                            -${{ number_format($venta->puntos_usados * config('services.crd.puntos'), 2) }}
                                        </span>
                                        <br>
                                        <span>{{$venta->puntos_usados}} puntos</span>
                                    </div>
                                </div>
                                <hr>
                            @endif
                        @endif
                        <!--TOTAL-->
                        <div class="contenedor_pago" style="font-size: 20px">
                            <div>
                                <span style="font-weight: 600;">TOTAL:</span>
                            </div>
                            <div>
                                @if ($venta->puntos_usados <= $puntos_cliente)
                                    ${{ number_format($venta->total, 2) }}
                                @else
                                    ${{ number_format($venta->total + $venta->puntos_usados * config('services.crd.puntos'), 2) }}
                                @endif
                            </div>
                        </div>
                        <div class="contenedor_boton_pagar">                          
                            <div id="paypal-button-container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- SDK Paypal --}}
    <script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}"></script>
    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: "{{ $venta->puntos_usados <= $puntos_cliente ? $venta->total : $venta->total + $venta->puntos_usados * config('services.crd.puntos') }}"
                            //value: "{{ $venta->total }}"
                            //value: 1
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                // This function captures the funds from the transaction.
                return actions.order.capture().then(function(details) {
                    // This function shows a transaction success message to your buyer.
                    //alert('Transaction completed by ' + details.payer.name.given_name);

                    window.location.href = '{{ route('cliente.venta.comprar.paypal', $venta) }}';
                });
            },
            onCancel: function(data) {
                window.location.href = '{{ route('cliente.venta.pagar', $venta) }}';
            },
            onError: function(err) {
                window.location.href = '{{ route('cliente.venta.pagar', $venta) }}';
            }
        }).render('#paypal-button-container');
    </script>
</div>
