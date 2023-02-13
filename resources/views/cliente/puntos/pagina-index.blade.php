<x-cliente-layout>

    <!--SEO-->
    @section('tituloPagina', 'CRD Puntos')
    @section('descripcion', 'En ' . env('APP_NAME') . ' puedes acumular puntos para canjear productos y servicios.')

    <!--CONTENEDOR PAGINA CLIENTE-->
    <div class="contenedor_pagina_cliente">

        <!--TITULO-->
        <h2 class="cliente_paginas_titulo">CRD Puntos</h2>

        <!--FORMULARIO-->
        <div class="formulario">
            <p style="font-size: 20px; font-weight: 700; color: #ffa03d;">¡Hola, {{ Auth::user()->cliente->nombre }}!</p>

            <br>

            <div class="contenedor_1_elementos_100">
                <p>Ya formas parte de los beneficios de CRD Puntos. <br> Ahora puedes canjear miles de productos y
                    seguir
                    <strong> acumulando CRD Puntos</strong> por cada compra que realices.
                </p>
            </div>

            <br>

            <div class="contenedor_1_elementos_100">
                <p><strong>Fecha de ingreso: </strong> {{ Auth::user()->cliente->created_at->format('d/m/Y') }}</p>
            </div>

            <div class="contenedor_1_elementos_100">
                <p><strong>Puntos acumulados: </strong> {{ Auth::user()->cliente->puntos }} puntos = USD
                    {{ Auth::user()->cliente->puntos * config('services.crd.puntos') }}</p>
            </div>

            <br>

            <div class="contenedor_1_elementos_100">
                <p>Recuerda que 1 punto equivale a {{ config('services.crd.puntos') }} dólares.</p>
            </div>

        </div>

    </div>

</x-cliente-layout>
