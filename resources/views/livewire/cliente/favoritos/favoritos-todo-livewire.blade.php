<div>

    <!--SEO-->
    @section('tituloPagina', 'Mis favoritos')
    @section('descripcion', 'En ' . env('APP_NAME') . ' puedes guardar los productos como tus favoritos.')

    <!--CONTENEDOR PAGINA CLIENTE-->
    <div class="contenedor_pagina_cliente">

        <!--TITULO-->
        <h2 class="cliente_paginas_titulo">Mis favoritos</h2>

        <!--LISTA-->
        @if (Cart::instance('wishlist')->count() > 0)

            <div class="contenedor_filtro_productos" x-data>
                @foreach (Cart::instance('wishlist')->content() as $item)
                    <div class="slider_producto_item">
                        <!--CONTENEDOR IMAGEN-->
                        <div class="slider_producto_imagen">
                            <a href="{{ route('producto.redirigir.id', $item->id) }}">
                                @if ($item->options->imagen)
                                    <img src="{{ $item->options->imagen }}" alt="" />
                                @else
                                    <img src="{{ asset('imagenes/producto/sin_foto_producto.png') }}">
                                @endif
                            </a>
                            <!--CONTENEDOR FAVORITO-->
                            <div>
                                <span class="agregar_favorito">
                                    <i wire:click="eliminarFavorito('{{ $item->rowId }}')"
                                        wire:loading.class="text-red-600 opacity-25"
                                        wire:target="eliminarFavorito('{{ $item->rowId }}')" class="fa-solid fa-heart"
                                        style="color: blue; cursor: pointer;"></i>
                                </span>
                            </div>
                        </div>

                        <!--CONTENEDOR DESCRIPCION-->
                        <div class="slider_producto_descripcion">
                            <h3>{{ $item->name }}</h3>
                            <h4>S/. {{ number_format($item->price, 2, '.', ',') }}</h4>
                        </div>

                        <!--CONTENEDOR PIE-->
                        <div class="slider_producto_pie">
                            <a href="{{ route('producto.redirigir.id', $item->id) }}">Ver producto</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="contenedor_no_existe_elementos">
                <p>No tienes favoritos.</p>
                <i class="fa-solid fa-spinner"></i>
            </div>
        @endif

    </div>

</div>
