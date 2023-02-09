<x-cliente-layout>
    @section('tituloPagina', 'Mis Puntos')
    <!--Titulo-->
    <div class="formulario">
        <h2 class="contenedor_paginas_titulo">CRD PUNTOS</h2>
        <p style="font-size: 20px; font-weight: 700; color: #ffa03d;">¡Hola, {{ Auth::user()->cliente->nombre }}!</p>
        <br>
        <div class="contenedor_1_elementos">
            <p>Ya formas parte de los beneficios de CRD Puntos. <br> Ahora puedes canjear miles de productos y seguir
                acumulando CRD Puntos por cada compra que realices.</p>
        </div>
        <br>
        <div class="contenedor_1_elementos">
            <label class="label_principal">
                <p class="estilo_nombre_input">Fecha de ingreso: </p>
                {{ Auth::user()->cliente->created_at->format('d/m/Y') }}
            </label>
            <label class="label_principal">
                <p class="estilo_nombre_input">Puntos acumulados: </p>
                {{ Auth::user()->cliente->puntos }} puntos = USD {{ Auth::user()->cliente->puntos * config('services.crd.puntos') }}
            </label>
        </div>
        <br>
        <div class="contenedor_1_elementos">
            <p>Recuerda que 1 punto equivale a 1.5 dolares.</p>
        </div>
    </div>
</x-cliente-layout>
