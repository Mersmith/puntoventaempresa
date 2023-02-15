<div class="contenedor_pagina_administrador">
    @section('tituloPagina', 'Orden | N° 00000-' . $venta->id)
    @php
        $envio = json_decode($venta->envio);
        $productosCarrito = json_decode($venta->contenido);
    @endphp
    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Orden</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.producto.index') }}">
                <i class="fa-solid fa-arrow-left"></i> Regresar</a>
        </div>
    </div>
    <!--CONTENEDOR CONTENIDO-->
    <div class="contenedor_administrador_contenido">

        <!--CONTENEDOR ORDEN DE COMPRA-->
        <div class="contenedor_orden_venta contenedor_panel_producto_admin">
            <!--CONTENEDOR CABECERA ORDEN DE COMPRA-->
            <div class="orden_venta_cabecera_numero">
                <img src="{{ asset('imagenes/empresa/logo.png') }}" alt="" />
                <span>N° de pedido: 00000-{{ $venta->id }}</span>
            </div>
            <!--CONTENEDOR ESTADO ORDEN DE COMPRA-->
            <div>
                <!--CONTENEDOR ESTADO ORDEN VENTA-->
                <div class="contenedor_estado_orden_venta">
                    <!--PAGADO 2-->
                    <div class="estado_orden_icono_texto">
                        <div class="estado_orden_icono"
                            style="background-color: {{ !$estado == 1 || ($estado >= 2 && $estado != 6) ? 'var(--color-fondo-secundario-boton)' : 'var(--color-fondo-terciario-boton)' }}">
                            <label>
                                <input type="radio" value="2" name="estado" wire:model="estado">
                                <i class="fa-solid fa-dollar-sign"></i>
                            </label>
                        </div>
                        <div>
                            <p>Pagado</p>
                        </div>
                    </div>
                    <div class="estado_orden_linea"
                        style="background-color: {{ $estado >= 3 && $estado != 6 ? 'var(--color-fondo-secundario-boton)' : 'var(--color-fondo-terciario-boton)' }}">
                    </div>
                    <!--ORDENADO O ALISTADO 3-->
                    <div class="estado_orden_icono_texto">
                        <div class="estado_orden_icono"
                            style="background-color: {{ $estado >= 3 && $estado != 6 ? 'var(--color-fondo-secundario-boton)' : 'var(--color-fondo-terciario-boton)' }}">
                            <label>
                                <input type="radio" value="3" name="estado" wire:model="estado">
                                <i class="fa-solid fa-list-check"></i>
                            </label>
                        </div>
                        <div>
                            <p>Alistado</p>
                        </div>
                    </div>
                    <div class="estado_orden_linea"
                        style="background-color: {{ $estado >= 4 && $estado != 6 ? 'var(--color-fondo-secundario-boton)' : 'var(--color-fondo-terciario-boton)' }}">
                    </div>
                    <!--ENVIADO 4-->
                    <div class="estado_orden_icono_texto">
                        <div class="estado_orden_icono"
                            style="background-color: {{ $estado >= 4 && $estado != 6 ? 'var(--color-fondo-secundario-boton)' : 'var(--color-fondo-terciario-boton)' }}">
                            <label>
                                <input type="radio" value="4" name="estado" wire:model="estado">
                                <i class="fas fa-truck"></i>
                            </label>
                        </div>
                        <div>
                            <p>Enviado</p>
                        </div>
                    </div>
                    <div class="estado_orden_linea"
                        style="background-color: {{ $estado >= 5 && $estado != 6 ? 'var(--color-fondo-secundario-boton)' : 'var(--color-fondo-terciario-boton)' }}">
                    </div>
                    <!--ENTREGADO 5-->
                    <div class="estado_orden_icono_texto">
                        <div class="estado_orden_icono"
                            style="background-color: {{ $estado >= 5 && $estado != 6 ? 'var(--color-fondo-secundario-boton)' : 'var(--color-fondo-terciario-boton)' }}">
                            <label>
                                <input type="radio" value="5" name="estado" wire:model="estado">
                                <i class="fa-solid fa-box-open"></i>
                            </label>
                        </div>
                        <div>
                            <p>Entregado</p>
                        </div>
                    </div>
                    <div class="estado_orden_linea"
                        style="background-color: {{ $estado >= 6 && $estado != 6 ? 'var(--color-fondo-secundario-boton)' : 'var(--color-fondo-terciario-boton)' }}">
                    </div>
                    <!--ANULADO 6-->
                    <div class="estado_orden_icono_texto">
                        <div class="estado_orden_icono"
                            style="background-color: {{ $estado >= 6 ? 'red' : 'var(--color-fondo-terciario-boton)' }}">
                            <label>
                                <input type="radio" value="6" name="estado" wire:model="estado">
                                <i class="fa-solid fa-ban"></i>
                            </label>
                        </div>
                        <div>
                            <p>Cancelado</p>
                        </div>
                    </div>
                </div>

                <!--CONTENEDOR BOTOENES ESTADO ORDEN-->
                <div class="contenedor_botones_estado_orden">
                    <!--BOTON ACTUALIZAR-->
                    <button class="contenedor_estado_orden_venta_boton orden_boton_actualizar"
                        wire:click="actualizarEstadoOrden" wire:loading.attr="disabled"
                        wire:target="actualizarEstadoOrden">
                        <span> Actualizar estado a:</span>
                        @if ($estado == 1)
                            Falta pagar
                        @elseif($estado == 2)
                            Pagado
                        @elseif($estado == 3)
                            Alistado
                        @elseif($estado == 4)
                            Enviado
                        @elseif($estado == 5)
                            Entregado
                        @elseif($estado == 6)
                            Anulado
                        @endif
                    </button>
                    <!--BOTON CANCELAR-->
                    <button class="contenedor_estado_orden_venta_boton orden_boton_cancelar"
                        wire:click="cancelarEstadoOrden" wire:loading.attr="disabled" wire:target="cancelarEstadoOrden">
                        <span> Cancelar</span>
                    </button>
                </div>
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
                                                    href="{{ route('producto.redirigir.id', $item->id) }}">{{ $item->name }}</a>
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
                    @php
                        $eventos = json_decode($venta->eventos);
                    @endphp

                    @foreach ($eventos as $evento)
                        <!--ITEM-->
                        <div class="item_contenedor_registro_eventos">
                            <div class="estado_registro_orden">
                                <span class="circulo_registro_orden"></span>
                                <span class="circulo_registro_linea"></span>
                            </div>
                            <div class="texto_registro_orden">
                                <p class="principal_registro_orden"><strong>Estado: {{ $evento->estado }}</strong></p>
                                <span class="descripcion_registro_orden">Fecha: {{ $evento->fecha }}</span>
                            </div>
                        </div>
                    @endforeach
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
                                    href="">Link</a></span> </li>
                    </ul>
                </div>
            </div>

            <!--CONTENEDOR BOTON DESCARGAR ORDEN-->
            <div class="contenedor_boton_descargar_orden">
                <button>Descargar</button>
            </div>
        </div>

    </div>
</div>
