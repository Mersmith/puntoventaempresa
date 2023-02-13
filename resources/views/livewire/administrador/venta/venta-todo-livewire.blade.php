<div class="contenedor_pagina_administrador">
    @section('tituloPagina', 'Ordenes')
    <!--Titulo-->
    <h2 class="contenedor_paginas_titulo">TODOS LAS ORDENES</h2>
    <!--Grid estado-->
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
    <!--Buscador-->
    <div class="contenedor_buscador">
        <input type="text" wire:model="buscarOrden" placeholder="Ingrese el contacto de la orden.">
    </div>
    <!--Contenedor tabla-->
    @if ($ordenes->count())
        <div class="py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Imagen</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                N° Orden</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Contacto</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Celular</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Estado</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Total</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
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
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-full h-full" src="{{ $primerProducto['options']['imagen'] }}"
                                            alt="" />
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    N° 00000-{{ $ordenItem->id }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $ordenItem->contacto }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $ordenItem->celular }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm  text-white">
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
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $ordenItem->total }} USD
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm cursor-pointer">
                                    <a href="{{ route('administrador.ordenes.editar', $ordenItem) }}">
                                        <span><i class="fa-solid fa-pencil" style="color: green;"></i></span>
                                        Ver</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="contenedor_no_existe_elementos">
            <p>No hay ordenes</p>
            <i class="fa-solid fa-spinner"></i>
        </div>
    @endif
    @if ($ordenes->hasPages())
        <div class="px-6 py-4">
            {{ $ordenes->links('pagination::tailwind') }}
        </div>
    @endif
</div>
