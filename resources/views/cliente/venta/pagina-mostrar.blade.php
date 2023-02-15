<x-web-layout>

    <div class="centrar_orden_compra">
        @section('tituloPagina', 'Orden | N° 00000-' . $venta->id)
        @php
            $envio = json_decode($venta->envio);
            $productosCarrito = json_decode($venta->contenido);
        @endphp
        <!--CONTENEDOR ORDEN DE COMPRA-->
        <div class="contenedor_orden_venta">
            <!--CONTENEDOR CABECERA ORDEN DE COMPRA-->
            <div class="orden_venta_cabecera_numero">
                <img src="{{ asset('imagenes/empresa/logo.png') }}" alt="" />
                <span>N° de pedido: 00000-{{ $venta->id }}</span>
            </div>
            <!--CONTENEDOR ESTADO ORDEN DE COMPRA-->
            <div>
                {{-- @livewire('administrador.orden.componente-estado-orden', ['ordenEstado' => $orden], key('componente-estado-orden-' . $orden->id)) --}}
            </div>

            <!--CONTENEDOR DETALLES DEL PEDIDO-->
            <div class="contenedor_detalle_orden">
                <!--CONTENEDOR CABECERA DETALLE-->
                <div class="contenedor_detalle_orden_cabecera">
                    <h2>Detalles del pedido</h2>
                    <div class="contenedor_botones_detalle_orden">
                        <button class="contenedor_botones_detalle_volver">Realizar pedido</button>
                        <button class="contenedor_botones_detalle_contrato">Ver contrato</button>
                    </div>
                </div>
                <!--CONTENEDOR PROVEEDOR Y COMPRADOR-->
                <div class="contenedor_orden_proveedor_comprador">
                    <div class="dividir_2_1">
                        <!--CONTENEDOR PROVEEDOR DETALLE-->
                        <div class="contenedor_proveedor_orden">
                            <div>
                                <span>PROVEEDOR:</span>
                                <p><strong>HTDent S.A.C.</strong></p>
                                <p>Nombre de contacto: Jessica Senlan</p>
                                <p>Dirección: N,Guangdong,Guangzhou,Room 306, No.</p>
                                <p>Tel: 17512951303</p>
                                <p>Correo electrónico de la empresa: jessica@vtuoge.com</p>

                            </div>
                        </div>
                        <!--CONTENEDOR CLIENTE DETALLE-->
                        <div class="contenedor_proveedor_orden">
                            <div>
                                <span>COMPRADOR:</span>
                                <p><strong>{{ $venta->contacto }}</strong></p>
                                <p>Nombre de contacto: {{ $venta->contacto }}</p>
                                <p>Tel: {{ $venta->celular }}</p>
                                <p>Correo electrónico: jessica@vtuoge.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contenedor_detalle_orden_cabecera">
                    <h2>Detalles del producto</h2>
                </div>
                <!--CONTENEDOR PRODUCTOS DETALLE-->
                <div class="contenedor_orden_tabla_producto">
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    N°.
                                </th>
                                <th>
                                    Imagen
                                </th>
                                <th>
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
                                    <td style="text-align: center;">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        <div class="tabla_imagen_orden">
                                            <img src="{{ $item->options->imagen }}" alt="">
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p><a
                                                    href="{{ route('producto.index', $item->id) }}">{{ $item->name }}</a>
                                            </p>
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
                                    <td>
                                        <div>
                                            <span>USD {{ number_format($item->price, 2) }}</span>
                                        </div>
                                    </td>
                                    <td style="text-align: center;">
                                        {{ $item->qty }}
                                    </td>
                                    <td style="text-align: end;">
                                        <div>
                                            USD {{ number_format($item->price * $item->qty, 2) }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td style="text-align: right;" colspan="5">SUBTOTAL:</td>
                                <td style="text-align: end;">
                                    ${{ number_format($venta->total - $venta->costo_envio + (float) $venta->cupon_precio + (float) $venta->puntos_canjeados * 1.5, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right;" colspan="5">ENVIO:</td>
                                <td style="text-align: end;">
                                    @if ($venta->tipo_envio == 1)
                                        Gratis
                                    @else
                                        ${{ number_format($venta->costo_envio, 2) }}
                                    @endif
                                </td>
                            </tr>
                            <!--CUPON-->
                            @if ($venta->cupon_descuento)
                                <tr>
                                    <td style="text-align: right;" colspan="5">CUPÓN:</td>
                                    <td style="text-align: end;">
                                        -${{ number_format($venta->cupon_precio, 2) }}
                                    </td>
                                </tr>
                            @endif
                            <!--PUNTOS-->
                            @if ($venta->puntos_canjeados)
                                <tr>
                                    <td style="text-align: right;" colspan="5">PUNTOS:</td>
                                    <td style="text-align: end;">
                                        -${{ number_format($venta->puntos_canjeados * 1.5, 2) }}
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td style="text-align: right;" colspan="5">TOTAL:</td>
                                <td style="text-align: end;"> ${{ number_format($venta->total, 2) }}
                                </td>
                            </tr>

                        </tfoot>
                    </table>
                </div>
                <div class="contenedor_detalle_orden_cabecera">
                    <h2>Detalles del envío</h2>
                </div>
                <!--CONTENEDOR ENVIO DETALLE-->
                <div class="contenedor_orden_tabla_producto">
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    Contacto
                                </th>
                                <th>
                                    Dirección
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <p><strong>{{ $venta->contacto }}</strong></p>
                                    <p>Nombre de contacto: {{ $venta->contacto }}</p>
                                    <p>Tel: {{ $venta->celular }}</p>
                                    <p>Correo electrónico: jessica@vtuoge.com</p>
                                </td>
                                <td>
                                    @if ($venta->tipo_envio == 1)
                                        <p><strong>Recojo en:</strong></p>
                                        <p>Tienda:Calle Pablo Usandizaga 683, San Borja, Lima, Perú</p>
                                    @else
                                        <p><strong>Enviado a:</strong></p>
                                        <p>Departamento: {{ $venta->departamento }}</p>
                                        <p>Provincia: {{ $venta->provincia }}</p>
                                        <p>Distrito: {{ $venta->distrito }}</p>
                                        <p>Dirección: {{ $venta->direccion }}</p>
                                        <p>Referencia: {{ $venta->referencia }}</p>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="contenedor_detalle_orden_cabecera">
                    <h2>Registros de operación</h2>
                </div>
                <!--REGISTRO DE EVENTOS-->
                <div class="contenedor_registro_eventos">
                    <!--ITEM-->
                    <div class="item_contenedor_registro_eventos">
                        <div class="estado_registro_orden">
                            <span class="circulo_registro_orden"></span>
                            <span class="circulo_registro_linea"></span>
                        </div>
                        <div class="texto_registro_orden">
                            <p class="principal_registro_orden"><strong>Order Received</strong></p>
                            <span class="descripcion_registro_orden">21st November, 201921st November, 201921st
                                November,
                                201921st November, 201921st November, 2019</span>
                        </div>
                    </div>
                    <!--ITEM-->
                    <div class="item_contenedor_registro_eventos">
                        <div class="estado_registro_orden">
                            <span class="circulo_registro_orden"></span>
                            <span class="circulo_registro_linea"></span>
                        </div>
                        <div class="texto_registro_orden">
                            <p class="principal_registro_orden"><strong>Order Received</strong></p>
                            <span class="descripcion_registro_orden">21st November, 2019</span>
                        </div>
                    </div>
                </div>
                <!--CONTENEDOR ENVIO DETALLE-->
                <div class="contenedor_detalle_orden_cabecera">
                    <h2>Condiciones de la Garantía comercial</h2>
                </div>
                <!--CONTENEDOR CONDICIONES DE LA GARANTIA-->
                <div class="contenedor_condiciones">
                    <p>Garantía posterior al envío</p>
                    <ul>
                        <li><span>Su pago real se cubrirá totalmente.</span></li>
                        <li><span>Si la calidad del producto no coincide con
                                el contrato o el proveedor no envía los productos a tiempo, puedes solicitar un
                                reembolso en un plazo de 30 días a contar de la entrega.</span></li>
                    </ul>
                </div>
                <!--CONTENEDOR ENVIO DETALLE-->
                <div class="contenedor_detalle_orden_cabecera">
                    <h2>Condiciones de la Garantía comercial</h2>
                </div>
                <!--CONTENEDOR DETALLES DEL ENVIO-->
                <div class="contenedor_condiciones">
                    <span>I am Emerson Smith Huallpa Zanabria, I want these products that work well. All products must
                        be well grouped.</span>
                </div>
                <!--CONTENEDOR ENVIO DETALLE-->
                <div class="contenedor_detalle_orden_cabecera">
                    <h2>Políticas</h2>
                </div>
                <!--CONTENEDOR POLÍTICAS-->
                <div class="contenedor_condiciones">
                    <p>Políticas despues de la compra</p>
                    <ul>
                        <li><span>Su pago real se cubrirá totalmente.<a href="">Link</a></span> </li>
                        <li><span>Si la calidad del producto no coincide con
                                el contrato o el proveedor no envía los productos a tiempo, puedes solicitar un
                                reembolso en un plazo de 30 días a contar de la entrega.<a
                                    href="">Link</a></span>
                        </li>
                    </ul>
                </div>
            </div>

            <!--CONTENEDOR BOTON DESCARGAR ORDEN-->
            <div class="contenedor_boton_descargar_orden">
                <button>Descargar</button>
            </div>
        </div>
    </div>

</x-web-layout>
