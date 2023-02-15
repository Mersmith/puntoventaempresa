<div>
    <!--SEO-->
    @section('tituloPagina', 'Ventas')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Ventas</h2>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">

        <!--GRID VENTAS-->
        <div class="contenedor_panel_producto_admin formulario">
            <div class="grid_estado_orden">
                <div class="grid_estado_0 estilo_estado_orden" style="background-color: rgb(35, 32, 226);">
                    <a href="{{ route('administrador.venta.index') }}">
                        <p class="text-center text-2xl">
                            {{ $todos }}
                        </p>
                        <p class="uppercase text-center">Todos</p>
                        <p class="text-center text-2xl mt-2">
                            <i class="fa-solid fa-boxes-stacked"></i>
                        </p>
                    </a>
                </div>
                <div class="grid_estado_1 estilo_estado_orden" style="background-color: rgb(245, 171, 11);">
                    <a href="{{ route('administrador.venta.index') . '?estado=1' }}">
                        <p class="text-center text-2xl">
                            {{ $pendiente }}
                        </p>
                        <p class="uppercase text-center">Falta Pagar</p>
                        <p class="text-center text-2xl mt-2">
                            <i class="fas fa-business-time"></i>
                        </p>
                    </a>
                </div>
                <div class="grid_estado_2 estilo_estado_orden" style="background-color: rgb(13, 235, 87);">
                    <a href="{{ route('administrador.venta.index') . '?estado=2' }}">
                        <p class="text-center text-2xl">
                            {{ $recibido }}
                        </p>
                        <p class="uppercase text-center">Alistado</p>
                        <p class="text-center text-2xl mt-2">
                            <i class="fa-solid fa-list-check"></i>
                        </p>
                    </a>
                </div>
                <div class="grid_estado_3 estilo_estado_orden" style="background-color: rgb(13, 191, 235);">
                    <a href="{{ route('administrador.venta.index') . '?estado=3' }}">
                        <p class="text-center text-2xl">
                            {{ $enviado }}
                        </p>
                        <p class="uppercase text-center">Enviado</p>
                        <p class="text-center text-2xl mt-2">
                            <i class="fas fa-truck"></i>
                        </p>
                    </a>
                </div>
                <div class="grid_estado_4 estilo_estado_orden" style="background-color: rgb(223, 13, 195);">
                    <a href="{{ route('administrador.venta.index') . '?estado=4' }}">
                        <p class="text-center text-2xl">
                            {{ $entregado }}
                        </p>
                        <p class="uppercase text-center">Entregado</p>
                        <p class="text-center text-2xl mt-2">
                            <i class="fa-solid fa-box-open"></i>
                        </p>
                    </a>
                </div>
                <div class="grid_estado_5 estilo_estado_orden" style="background-color: rgb(243, 57, 10);">
                    <a href="{{ route('administrador.venta.index') . '?estado=5' }}">
                        <p class="text-center text-2xl">
                            {{ $anulado }}
                        </p>
                        <p class="uppercase text-center">Anulado</p>
                        <p class="text-center text-2xl mt-2">
                            <i class="fas fa-times-circle"></i>
                        </p>
                    </a>
                </div>
            </div>
        </div>

        <br>

        @if ($ordenes->count())

            <!--BUSCADOR-->
            <div class="contenedor_panel_producto_admin formulario">
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Buscar orden: <span class="campo_opcional">(Opcional)</span> </p>
                    <input type="text" wire:model="buscarOrden"
                        placeholder="Ingrese el nombre del producto que quiere buscar.">
                </div>
            </div>

            <!--TABLA-->
            <div class="contenedor_panel_producto_admin">
                <!--CONTENEDOR SUBTITULO-->
                <div class="contenedor_subtitulo_admin">
                    <h3>Lista</h3>
                </div>

                <!--CONTENEDOR BOTONES-->
                <div class="contenedor_botones_admin">
                    <button>
                        PDF <i class="fa-solid fa-file-pdf"></i>
                    </button>
                    <button>
                        EXCEL <i class="fa-regular fa-file-excel"></i>
                    </button>
                    <button onClick="window.scrollTo(0, document.body.scrollHeight);">
                        Abajo <i class="fa-solid fa-arrow-down"></i>
                    </button>
                </div>

                <!--TABLA-->
                <div class="tabla_administrador py-4 overflow-x-auto">
                    <div class="inline-block min-w-full overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th>
                                        Imagen</th>
                                    <th>
                                        N° Orden</th>
                                    <th>
                                        Contacto</th>
                                    <th>
                                        Celular</th>
                                    <th>
                                        Estado</th>
                                    <th>
                                        Total</th>
                                    <th>
                                        Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ordenes as $ordenItem)
                                    @php
                                        $productosCarrito = json_decode($ordenItem->contenido, true);
                                        $primerProducto = array_values($productosCarrito)[0];
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="tabla_imagen">
                                                @if ($primerProducto['options']['imagen'])
                                                    <img src="{{ $primerProducto['options']['imagen'] }}"
                                                        alt="" />
                                                @else
                                                    <img src="{{ asset('imagenes/producto/sin_foto_producto.png') }}">
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            N° 00000-{{ $ordenItem->id }}
                                        </td>
                                        <td>
                                            {{ $ordenItem->contacto }}
                                        </td>
                                        <td>
                                            {{ $ordenItem->celular }}
                                        </td>
                                        <td>
                                            @switch($ordenItem->estado)
                                                @case(1)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                        style="background-color: rgb(245, 171, 11);">
                                                        Falta
                                                    </span>
                                                @break

                                                @case(2)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                        style="background-color: rgb(13, 235, 87);">
                                                        Alistando
                                                    </span>
                                                @break

                                                @case(3)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                        style="background-color: rgb(13, 191, 235);">
                                                        Enviando
                                                    </span>
                                                @break

                                                @case(4)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                        style="background-color: rgb(223, 13, 195);">
                                                        Entregado
                                                    </span>
                                                @break

                                                @case(5)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                        style="background-color: rgb(243, 57, 10);">
                                                        Anulado
                                                    </span>
                                                @break

                                                @default
                                            @endswitch
                                        </td>
                                        <td>
                                            {{ $ordenItem->total }} USD
                                        </td>
                                        <td>
                                            <a class="tabla_editar"
                                                href="{{ route('administrador.venta.editar', $ordenItem) }}">
                                                <i class="fa-solid fa-pencil"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            @if ($ordenes->hasPages())
                <div>
                    {{ $ordenes->links('pagination::tailwind') }}
                </div>
            @endif
        @else
            <div class="contenedor_no_existe_elementos">
                <p>No hay elementos</p>
                <i class="fa-solid fa-spinner"></i>
            </div>
        @endif

    </div>

</div>
