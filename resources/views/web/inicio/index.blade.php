<x-web-layout>
    <!--SEO-->
    @section('tituloPagina', 'Inicio')

    <!--CONTENIDO PÁGINA-->

    <!--SLIDER PRINCIPAL-->
    @if ($sliders->count())
        @include('web.inicio.slider-principal')
    @endif

    <!--SLIDER CATEGORIA-->
    @if ($categorias->count())
        @include('web.inicio.slider-categoria')
    @endif

    <!--SLIDER PRODUCTO 1 FECHA DE CREACIÓN-->
    @livewire('web.inicio.slider-producto1')

    <!--SLIDER PRODUCTO 2 CATEGORIA-->
    @livewire('web.inicio.slider-producto2')

    <!--SLIDER PRODUCTO 3 SUBCATEGORIA-->
    @livewire('web.inicio.slider-producto3')

    <!--SLIDER PRODUCTO 4 PRECIO-->
    @livewire('web.inicio.slider-producto4')

    <!--SLIDER PRODUCTO 5 BUSCADOS-->
    @livewire('web.inicio.slider-producto5')

    <!--BANNER PROMOCIONAL 1-->
    @include('web.inicio.banner-promocional')

    <!--IMAGEN PROMOCIONAL-->
    @include('web.inicio.imagen-promocional')

    <!--PRODUCTOS ESPECIALES 1-->
    @include('web.inicio.productos-especiales')

    @push('script')
        <script>
            Livewire.on('gliderSliderProducto', function(id) {
                new Glider(document.querySelector('.gliderSliderProducto-' + id), {
                    slidesToShow: 5,
                    slidesToScroll: 5,
                    draggable: true,
                    arrows: {
                        prev: '.gliderSliderProducto-' + id + '~ .gliderSliderProducto-prev',
                        next: '.gliderSliderProducto-' + id + '~ .gliderSliderProducto-next'
                    },
                    responsive: [{
                        breakpoint: 300,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }, {
                        breakpoint: 640,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    }, {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4
                        }
                    }, {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 6,
                            slidesToScroll: 6
                        }
                    }]
                });
            });
        </script>
    @endpush

</x-web-layout>
