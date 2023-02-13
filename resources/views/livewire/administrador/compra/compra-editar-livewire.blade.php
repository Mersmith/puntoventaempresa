<div>
    <!--SEO-->
    @section('tituloPagina', 'COMPRAS')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Compras</h2>
        </div>

        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.compra.index') }}">
                <i class="fa-solid fa-arrow-left"></i> Regresar</a>
            <button wire:click="$emit('eliminarCompraModal')">
                Eliminar <i class="fa-solid fa-trash-can"></i>
            </button>
            <a href="{{ route('administrador.compra.crear') }}">
                Crear <i class="fa-solid fa-square-plus"></i></a>
            <a href="{{ route('administrador.compra.pdf', $compra) }}" target="_blank">
                PDF <i class="fa-solid fa-file-pdf"></i></a>
            <a href="{{ route('administrador.compra.imprimir', $compra) }}" target="_blank">
                Imprimir <i class="fa-solid fa-print"></i></a>
        </div>
    </div>

    <!--CONTENEDOR CONTENIDO-->
    <div class="contenedor_administrador_contenido">

        <!--CONTENEDOR ORDEN DE COMPRA-->
        <div class="contenedor_orden_venta contenedor_panel_producto_admin">

            <!--CONTENEDOR CABECERA ORDEN DE COMPRA-->
            <div class="orden_venta_cabecera_numero">
                <img src="{{ asset('imagenes/empresa/logo.png') }}" alt="" />
                <span>N° de pedido: 00000-{{ $compra->id }}</span>
            </div>

            <!--CONTENEDOR DETALLES DEL PEDIDO-->
            <div class="contenedor_detalle_orden">
                <!--CONTENEDOR CABECERA DETALLE-->
                <div class="contenedor_detalle_orden_cabecera">
                    <h2>Detalles de la compra</h2>
                    <!--ESTADO-->
                    <div>
                        @switch($estado)
                            @case(1)
                                <span>
                                    PENDIENTE
                                </span>
                            @break

                            @case(2)
                                <span>
                                    PAGADO
                                </span>
                            @break

                            @case(3)
                                <span>
                                    ORDENADO
                                </span>
                            @break

                            @case(4)
                                <span>
                                    ENVIADO
                                </span>
                            @break

                            @case(5)
                                <span>
                                    ENTREGADO
                                </span>
                            @break

                            @case(6)
                                <span>
                                    ANULADO
                                </span>
                            @break

                            @default
                        @endswitch
                    </div>
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
                                <p><strong>{{ $proveedor }}</strong></p>
                            </div>
                        </div>
                        <!--CONTENEDOR CLIENTE DETALLE-->
                        <div class="contenedor_proveedor_orden">
                            <div>
                                <span>COMPRADOR:</span>
                                <p><strong>HtDent</strong></p>
                                <p>Nombre de contacto: {{ $personal }}</p>
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
                            @foreach ($detalle_compra as $item)
                                <tr>
                                    <td style="text-align: center;">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        <div class="tabla_imagen_orden">
                                            @if ($item->producto->imagenes->count())
                                                <img src="{{ Storage::url($item->producto->imagenes->first()->imagen_ruta) }}"
                                                    alt="" />
                                            @else
                                                <img src="{{ asset('imagenes/producto/sin_foto_producto.png') }}">
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p><a
                                                    href="{{ route('producto.index', $item->producto->id) }}">{{ $item->producto->nombre }}</a>
                                            </p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span>USD {{ number_format($item->precio, 2) }}</span>
                                        </div>
                                    </td>
                                    <td style="text-align: center;">
                                        {{ $item->cantidad }}
                                    </td>
                                    <td style="text-align: end;">
                                        <div>
                                            USD {{ number_format($item->precio * $item->cantidad, 2) }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        @php
                            $subTotal = $total / (1 + $impuesto / 100);
                        @endphp
                        <tfoot>
                            <tr>
                                <td style="text-align: right;" colspan="5">SUBTOTAL:</td>
                                <td style="text-align: end;">
                                    ${{ $subTotal }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right;" colspan="5">IMPUESTO ({{ $impuesto }}):</td>
                                <td style="text-align: end;">
                                    ${{ ($subTotal * $impuesto) / 100 }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right;" colspan="5">TOTAL:</td>
                                <td style="text-align: end;"> ${{ number_format($total, 2) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>
