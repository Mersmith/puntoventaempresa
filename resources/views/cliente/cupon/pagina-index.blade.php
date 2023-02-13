<x-cliente-layout>
    @section('tituloPagina', 'Mis Cupones')

    <!--CONTENEDOR PAGINA PERFIL-->
    <div class="contenedor_pagina_perfil">

        <!--TITULO-->
        <h2 class="cliente_paginas_titulo">MIS CUPÓNES</h2>

        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_cliente">
            <a href="{{ route('tienda.index') }}">
                Ir a comprar <i class="fa-solid fa-gifts"></i></a>
        </div>

        <!--LISTA-->
        @if ($cupones->count())
            @foreach ($cupones as $cupon)
                <div
                    style="display: flex; padding: 10px; border: 1.5px solid #cfd3d9; margin: 10px 0px; border-radius: 5px;">
                    <div style="margin-right: 5px;"><i class="fa-solid fa-tags"></i></div>
                    <div>
                        <p>Descuento:
                            @if ($cupon->tipo == 'fijo')
                                ${{ $cupon->descuento }}
                            @else
                                %{{ $cupon->descuento }}
                            @endif
                        </p>
                        <p style="font-weight: 600">CÓDIGO: {{ $cupon->codigo }}</p>
                        <p>Solo para compras de un monto de: ${{ $cupon->carrito_monto }}</p>
                        <p>Inicio: {{ $cupon->fecha_inicio }} - <span style="font-weight: 600">Fin:
                                {{ $cupon->fecha_expiracion }}</span></p>
                        <p style="font-weight: 500; color: #009eff;">Vence en
                            @php
                                $fechaVencimiento = new DateTime($cupon->fecha_expiracion);
                                $fechaActual = new DateTime();
                                $diferencia = $fechaVencimiento->diff($fechaActual);
                                $diasRestantes = $diferencia->format('%a');
                                echo $diasRestantes + 1;
                            @endphp
                            días
                        </p>
                    </div>
                </div>
            @endforeach
        @else
            <div class="contenedor_no_existe_elementos">
                <p>No tienes cupónes</p>
                <i class="fa-solid fa-spinner"></i>
            </div>
        @endif

    </div>
</x-cliente-layout>
