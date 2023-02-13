<div>
    <!--SEO-->
    @section('tituloPagina', 'COMPRAS')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Compras</h2>
        </div>

        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.compra.crear') }}">
                Crear compra <i class="fa-solid fa-square-plus"></i></a>
        </div>
    </div>

    <!--CONTENEDOR CONTENIDO-->
    <div class="contenedor_administrador_contenido">

        @if ($compras->count())

            <!--BUSCADOR-->
            <div class="contenedor_panel_producto_admin formulario">
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Buscar compra: <span class="campo_opcional">(Opcional)</span> </p>
                    <input type="text" wire:model="buscarCompra" placeholder="Ingrese la compra.">
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
                                        Fecha</th>
                                    <th>
                                        Total</th>
                                    <th>
                                        Impuesto</th>
                                    <th>
                                        Proveedor</th>
                                    <th>
                                        Personal</th>
                                    <th>
                                        Estado</th>
                                    <th>
                                        Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($compras as $compra)
                                    <tr>
                                        <td>
                                            {{ $compra->created_at }}
                                        </td>
                                        <td>
                                            {{ $compra->total }}
                                        </td>
                                        <td>
                                            {{ $compra->impuesto }}
                                        </td>
                                        <td>
                                            {{ $compra->proveedor->nombre }}
                                        </td>
                                        <td>
                                            {{ $compra->user->email }}
                                        </td>
                                        <td>
                                            @switch($compra->estado)
                                                @case(1)
                                                    <span>
                                                        PENDIENTE
                                                    </span>
                                                @break

                                                @case(2)
                                                    <span>
                                                        PAGADO
                                                    </span>
                                                @break

                                                @case(3)
                                                    <span>
                                                        ORDENADO
                                                    </span>
                                                @break

                                                @case(4)
                                                    <span>
                                                        ENVIADO
                                                    </span>
                                                @break

                                                @case(5)
                                                    <span>
                                                        ENTREGADO
                                                    </span>
                                                @break

                                                @case(6)
                                                    <span>
                                                        ANULADO
                                                    </span>
                                                @break

                                                @default
                                            @endswitch
                                        </td>
                                        <td>
                                            <a style="color: green;"
                                                href="{{ route('administrador.compra.editar', $compra) }}">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($compras->hasPages())
                    <div>
                        {{ $productos->links('pagination::tailwind') }}
                    </div>
                @endif
                
            </div>
        @else
            <div class="contenedor_no_existe_elementos">
                <p>No hay elementos</p>
                <i class="fa-solid fa-spinner"></i>
            </div>
        @endif

    </div>

</div>
