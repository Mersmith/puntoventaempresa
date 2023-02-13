<div>
    <!--SEO-->
    @section('tituloPagina', 'Crear producto')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Asigar cliente</h2>
        </div>

        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.cupon.index') }}">
                <i class="fa-solid fa-arrow-left"></i> Regresar</a>
        </div>
    </div>

    <!--CONTENEDOR CONTENIDO-->
    <div class="contenedor_administrador_contenido" x-data>

        <!--FORMULARIO-->
        <div x-data class="formulario contenedor_panel_producto_admin">
            <!--CLIENTE-->
            <div class="contenedor_2_elementos">
                <!--CUPÓN-->
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Cupón: </p>
                    <input type="text" value="{{ $cupon->codigo }}" disabled>
                </div>
                <!--CLIENTE-->
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Proveedores: <span class="campo_obligatorio">(Obligatorio)</span></p>
                    <select wire:model="cliente_id">
                        <option value="" selected disabled>Seleccione un cliente</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                    @error('cliente_id')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!--ENVIAR-->
            <div class="contenedor_1_elementos">
                <button wire:target="asignarCupon" wire:click="asignarCupon">
                    Agregar cupón
                </button>
            </div>
        </div>

        <!--ENVIAR-->
        <div class="contenedor_1_elementos">
            <button wire:target="asignarCuponVarios" wire:click="asignarCuponVarios">
                Asignar varios
            </button>
        </div>

        <!--LISTA-->
        <div class="contenedor_panel_producto_admin">

            @if ($asignados->count())
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
                                        Nombre</th>
                                    <th>
                                        Uso</th>
                                    <th>
                                        Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($asignados as $asignado)
                                    <tr>
                                        <td>
                                            {{ $asignado->cliente->nombre }}
                                        </td>
                                        <td>
                                            {{ $asignado->uso ? 'Sí' : 'No' }}
                                        </td>
                                        <td>
                                            <a style="color: green;"
                                                wire:click="editarAsignacion('{{ $asignado->id }}')">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a> |
                                            <a style="color: red;"
                                                wire:click="$emit('eliminarCuponModal', '{{ $asignado->cliente->id }}')">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="contenedor_no_existe_elementos">
                    <p>No hay elementos</p>
                    <i class="fa-solid fa-spinner"></i>
                </div>
            @endif
        </div>

    </div>

    @if ($cliente_cupon)
        <!--MODAL-->
        <x-jet-dialog-modal wire:model="abierto">
            <!--TITULO-->
            <x-slot name="title">
                <div class="contenedor_titulo_modal">
                    <!--ENCABEZADO-->
                    <div>
                        <h2 style="font-weight: bold">Editar</h2>
                    </div>

                    <!--CERRAR-->
                    <div>
                        <button wire:click="$set('abierto', false)" wire:loading.attr="disabled">
                            <i style="cursor: pointer; color: #666666;" class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>
            </x-slot>
            <!--CONTENIDO-->
            <x-slot name="content">
                <div class="formulario">
                    <!--USO-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">¿Uso el cupón?: <span
                                    class="campo_obligatorio">(Obligatorio)</span>
                            </p>
                            <div>
                                <label>
                                    <input type="radio" value="0" name="estado_cupon"
                                        wire:model.defer="estado_cupon">
                                    No
                                </label>
                                <label>
                                    <input type="radio" value="1" name="estado_cupon"
                                        wire:model.defer="estado_cupon">
                                    Si
                                </label>
                            </div>
                            @error('estado_cupon')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <div class="contenedor_pie_modal">
                    <button style="background-color: #009eff;" wire:click="$set('abierto', false)"
                        wire:loading.attr="disabled" type="submit">Cancelar</button>

                    <button style="background-color: #ffa03d;" wire:click="actualizarAsignacion" wire:loading.attr="disabled"
                        wire:target="actualizarAsignacion" type="submit">Editar</button>
                </div>
            </x-slot>
        </x-jet-dialog-modal>
    @endif
</div>

<!--SCRIPT-->
@push('script')
    <script>
        Livewire.on('eliminarCuponModal', clienteId => {
            Swal.fire({
                title: '¿Quieres eliminar?',
                text: "No podrás recuparlo.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('administrador.cupon.cupon-ver-livewire',
                        'eliminarAsignacion', clienteId);
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
