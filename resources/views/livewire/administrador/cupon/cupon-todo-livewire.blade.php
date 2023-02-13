<div>
    <!--SEO-->
    @section('tituloPagina', 'Cupones')

    @if (Session::has('message'))
        <div>{{ Session::get('message') }} </div>
    @endif

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Cupones</h2>
        </div>

        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.cupon.crear') }}">
                Crear <i class="fa-solid fa-square-plus"></i></a>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">
        @if ($cupones->count())

            <!--BUSCADOR-->
            <div class="contenedor_panel_producto_admin formulario">
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Buscar cupón: <span class="campo_opcional">(Opcional)</span> </p>
                    <input type="text" wire:model="buscarCupon"
                        placeholder="Ingrese el nombre del cupón que quiere buscar.">
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
                                        Código Cupon</th>
                                    <th>
                                        Tipo</th>
                                    <th>
                                        Descuento</th>
                                    <th>
                                        Monto Carrito</th>
                                    <th>
                                        Límite</th>
                                    <th>
                                        Usado</th>
                                    <th>
                                        Expiración</th>
                                    <th>
                                        Estado</th>
                                    <th>
                                        Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cupones as $cupon)
                                    <tr>
                                        <td>
                                            {{ $cupon->codigo }}
                                        </td>
                                        <td>
                                            {{ $cupon->tipo }}
                                        </td>
                                        <td>
                                            @switch($cupon->tipo)
                                                @case('fijo')
                                                    ${{ $cupon->descuento }}.00
                                                @break

                                                @case('porcentaje')
                                                    {{ $cupon->descuento }}%
                                                @break

                                                @default
                                            @endswitch
                                        </td>
                                        <td>
                                            ${{ $cupon->carrito_monto }}
                                        </td>
                                        <td>
                                            {{ $cupon->limite }}
                                        </td>
                                        <td>
                                            {{ $cupon->usado }}
                                        </td>
                                        <td>
                                            Inicio: {{ $cupon->fecha_inicio }} - <span style="font-weight: 600">Fin:
                                                {{ $cupon->fecha_expiracion }}
                                        </td>
                                        <td>
                                            @if ($cupon->fecha_expiracion > $cupon->fecha_inicio)
                                                Falta @php
                                                    $fechaActual = date('Y-m-d');
                                                    $datetime1 = date_create($cupon->fecha_expiracion);
                                                    $datetime2 = date_create($fechaActual);
                                                    $contador = date_diff($datetime2, $datetime1);
                                                    $differenceFormat = '%a';
                                                    echo $contador->format($differenceFormat);
                                                @endphp días
                                            @else
                                                Vencido
                                            @endif
                                        </td>
                                        <td>
                                            <a style="color: #009eff;"
                                                href="{{ route('administrador.cupon.ver', $cupon) }}">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            |
                                            <a style="color: green;"
                                                href="{{ route('administrador.cupon.editar', ['cupon' => $cupon->id]) }}">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                            |
                                            <a style="color: red;"
                                                wire:click="$emit('eliminarCuponModal', '{{ $cupon->id }}')">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($cupones->hasPages())
                    <div>
                        {{ $cupones->links('pagination::tailwind') }}
                    </div>
                @endif

            </div>
        @else
            <div class="contenedor_no_existe_elementos">
                <p>No hay cupones</p>
                <i class="fa-solid fa-spinner"></i>
            </div>
        @endif
    </div>

</div>

@push('script')
    <script>
        Livewire.on('eliminarCuponModal', cuponId => {
            Swal.fire({
                title: '¿Quieres eliminar?',
                text: "No podrás recupar este cupón.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('administrador.cupon.cupon-todo-livewire',
                        'eliminarCupon', cuponId);
                    Swal.fire(
                        '¡Eliminado!',
                        'Eliminaste correctamente.',
                        'success'
                    );
                }
            })
        });
    </script>
@endpush
