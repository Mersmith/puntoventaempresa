<div>

    <!--SEO-->
    @section('tituloPagina', 'Clientes')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Clientes</h2>
        </div>

        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.cliente.crear') }}">
                Crear <i class="fa-solid fa-square-plus"></i></a>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">

        @if ($clientes->count())

            <!--BUSCADOR-->
            <div class="contenedor_panel_producto_admin formulario">
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Buscar producto: <span class="campo_opcional">(Opcional)</span> </p>
                    <input type="text" wire:model="buscarCliente" placeholder="Ingrese el nombre del cliente.">
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
                                        Nombre</th>
                                    <th>
                                        Email</th>
                                    <th>
                                        Celular</th>
                                    <th>
                                        Puntos</th>
                                    <th>
                                        Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                    <tr>
                                        <td>
                                            <div style="width: 20px; height: 20px;">
                                                @if ($cliente->imagen)
                                                    <img src="{{ Storage::url($cliente->imagen->imagen_ruta) }}"
                                                        alt="" />
                                                @else
                                                    <img src="{{ asset('imagenes/perfil/sin_foto_perfil.png') }}">
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            {{ $cliente->nombre }}
                                        </td>
                                        <td>
                                            {{ $cliente->email }}
                                        </td>
                                        <td>
                                            {{ $cliente->celular }}
                                        </td>
                                        <td>
                                            {{ $cliente->puntos }}
                                        </td>
                                        <td>
                                            <a href="{{ route('administrador.cliente.editar', $cliente) }}">
                                                <span><i class="fa-solid fa-pencil"></i></span>
                                                Editar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if ($clientes->hasPages())
                <div>
                    {{ $clientes->links('pagination::tailwind') }}
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
