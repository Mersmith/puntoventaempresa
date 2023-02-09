@php
    $json_menu_cliente = file_get_contents('menuCliente.json');
    $menuPrincipalCliente = collect(json_decode($json_menu_cliente, true));
@endphp

<div class="item_menu_cliente">

    @foreach ($menuPrincipalCliente as $key => $menu)
        <a href="{{ route($menu['nombrePrincipalUrl']) }}"><i
                class="{{ $menu['iconoPrincipal'] }}"></i><span>{{ $menu['nombrePrincipal'] }}</span></a>
        <hr>
    @endforeach

    <form method="POST" action="{{ route('logout') }}" x-data>
        @csrf

        <a href="{{ route('logout') }}" @click.prevent="$root.submit();"><i
                class="fa-solid fa-right-from-bracket"></i><span>Cerrar
                sesión</span></a>
    </form>


    {{-- <a href="{{ route('cliente.orden.index') }}"s><i
        class="fas fa-truck"></i><span>Pedidos</span></a>
<a href="{{ route('cliente.favoritos') }}"s><i
        class="fas fa-truck"></i><span>Favoritos</span></a>
<a href="{{ route('cliente.puntos.crd') }}"><i
        class="fa-solid fa-arrows-to-circle"></i><span>CRD Puntos</span></a>
<a><i class="fa-solid fa-comments"></i><span>Reseñas</span></a>
<a href="{{ route('cliente.cupon.index') }}"><i
        class="fa-solid fa-clipboard-check"></i><span>Cupones</span></a>
<hr> --}}


</div>
