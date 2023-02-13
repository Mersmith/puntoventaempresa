<x-cliente-layout>
    <?php
    $estado = $_GET['estado'] ?? '';
    $titulo = '';
    if ($estado == 1) {
        $titulo = ' | Falta Pagar';
    } elseif ($estado == 2) {
        $titulo = ' | Alistado';
    } elseif ($estado == 3) {
        $titulo = ' | Enviado';
    } elseif ($estado == 4) {
        $titulo = ' | Entregado';
    } elseif ($estado == 5) {
        $titulo = ' | Anulado';
    } else {
        $titulo = ' | Todos';
    }
    ?>
    @section('tituloPagina', 'Mis Ordenes' . $titulo)
    <h2 class="contenedor_paginas_titulo">MIS ORDENES</h2>
    <div class="formulario">
        <!--Dos input-->
        <div class="contenedor_2_elementos">
            <!--Provincia-->
            <label class="label_principal">
                <p class="estilo_nombre_input">Estado de la Orden: </p>
                <select onchange="window.location.href=this.value;">
                    <option selected value="{{ route('cliente.venta.index') }}">Todos</option>
                    <option {{ $estado == 1 ? 'selected' : '' }}
                        value="{{ route('cliente.venta.index') . '?estado=1' }}">Falta
                        pagar</option>
                    <option {{ $estado == 2 ? 'selected' : '' }}
                        value="{{ route('cliente.venta.index') . '?estado=2' }}">
                        Alistado</option>
                    <option {{ $estado == 3 ? 'selected' : '' }}
                        value="{{ route('cliente.venta.index') . '?estado=3' }}">Enviado
                    </option>
                    <option {{ $estado == 4 ? 'selected' : '' }}
                        value="{{ route('cliente.venta.index') . '?estado=4' }}">
                        Entregado</option>
                    <option {{ $estado == 5 ? 'selected' : '' }}
                        value="{{ route('cliente.venta.index') . '?estado=5' }}">
                        Anulado</option>
                </select>
            </label>
        </div>
    </div>

    @if ($ventas->count())
        <!--Pedidos-->
        <div>
            <section>
                <ul>
                    @foreach ($ventas as $venta)
                        <li style="border: 1px solid #ccc; border-radius: 5px; margin: 10px 0px;">
                            <a href="{{ $venta->estado == 1 ? route('cliente.venta.pagar', $venta) : route('cliente.venta.mostrar', $venta) }}"
                                class="flex items-center py-2 px-4 hover:bg-gray-100">
                                <span class="w-12 text-center">
                                    @switch($venta->estado)
                                        @case(1)
                                            <i class="fas fa-business-time" style="color: rgb(245, 171, 11);"></i>
                                        @break

                                        @case(2)
                                            <i class="fa-solid fa-list-check" style="color: rgb(13, 235, 87);"></i>
                                        @break

                                        @case(3)
                                            <i class="fas fa-truck" style="color: rgb(13, 191, 235);"></i>
                                        @break

                                        @case(4)
                                            <i class="fa-solid fa-box-open" style="color: rgb(223, 13, 195);"></i>
                                        @break

                                        @case(5)
                                            <i class="fas fa-times-circle" style="color: rgb(243, 57, 10);"></i>
                                        @break

                                        @default
                                    @endswitch
                                </span>

                                <span>
                                    <strong>Orden: N° 00000-{{ $venta->id }}</strong>
                                    <br>
                                    {{ $venta->created_at->format('d/m/Y') }}
                                </span>

                                <div class="ml-auto">
                                    <span class="font-bold">
                                        @switch($venta->estado)
                                            @case(1)
                                                Ir a Pagar
                                            @break

                                            @case(2)
                                                Alistado
                                            @break

                                            @case(3)
                                                Enviado
                                            @break

                                            @case(4)
                                                Entregado
                                            @break

                                            @case(5)
                                                Anulado
                                            @break

                                            @default
                                        @endswitch
                                    </span>

                                    <div class="formulario">
                                        <button>
                                            Ver
                                        </button>
                                    </div>
                                    <span class="text-sm">
                                        {{ number_format($venta->total, 2) }} USD
                                    </span>
                                </div>

                                <span>
                                    <i class="fas fa-angle-right ml-6"></i>
                                </span>

                            </a>
                            <hr>
                            <div class="flex items-center py-2 px-4">
                                @php
                                    $productosCarrito = json_decode($venta->contenido, true);
                                    $primerProducto = array_values($productosCarrito)[0];
                                @endphp
                                <img width="50px" src="{{ $primerProducto['options']['imagen'] }}" alt="">
                                <p style="margin-left: 5px;">{{ $primerProducto['name'] }}...</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </section>
        </div>
    @else
        <div>
            No tiene ordenes
        </div>
    @endif
    <div>{{ $ventas->links() }} </div>
</x-cliente-layout>
