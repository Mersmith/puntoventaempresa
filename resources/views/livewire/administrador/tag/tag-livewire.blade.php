<div>
    <!--SEO-->
    @section('tituloPagina', 'Tags')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Etiquetas</h2>
        </div>
    </div>
    <!--CONTENEDOR CONTENIDO-->
    <div class="contenedor_administrador_contenido" x-data>

        <!--FORMULARIOS-->
        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Nueva etiqueta</h3>
            </div>
            <!--FORMULARIOS-->
            <form wire:submit.prevent="crearTag" class="formulario">
                <!--NOMBRE-->
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Nombre: <span class="campo_obligatorio">(Obligatorio)</span></p>
                    <input type="text" wire:model="crearFormulario.nombre">
                    @error('crearFormulario.nombre')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>

                <!--SLUG-->
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Slug: <span class="campo_obligatorio">(Obligatorio)</span></p>
                    <input type="text" wire:model="crearFormulario.slug">
                    @error('crearFormulario.slug')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>

                <!--DESCRIPCIÓN-->
                <div class="contenedor_1_elementos_100">
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Descripción: <span class="campo_opcional">(Opcional)</span>
                        </p>
                        <textarea rows="2" wire:model="crearFormulario.descripcion"></textarea>
                        @error('crearFormulario.descripcion')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--ENVIAR-->
                <div class="contenedor_1_elementos">
                    <input type="submit" value="Crear Tag">
                </div>
            </form>
        </div>
        <!--LISTA-->
        <div class="contenedor_panel_producto_admin">
            @if ($tags->count())
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
                                        Ruta</th>
                                    <th>
                                        Descripción</th>
                                    <th>
                                        Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tags as $tagItem)
                                    <tr>
                                        <td>
                                            {{ $tagItem->nombre }}
                                        </td>
                                        <td>
                                            {{ $tagItem->slug }}
                                        </td>
                                        <td>
                                            {{ Str::limit($tagItem->descripcion, 20) }}
                                        </td>
                                        <td>
                                            <a style="color: green;" wire:click="editarTag('{{ $tagItem->slug }}')">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a> |
                                            <a style="color: red;"
                                                wire:click="$emit('eliminarTagModal', '{{ $tagItem->slug }}')">
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


    @if ($tag)
        <!--MODAL-->
        <x-jet-dialog-modal wire:model="editarFormulario.abierto">
            <!--TITULO-->
            <x-slot name="title">
                <div class="contenedor_titulo_modal">
                    <!--ENCABEZADO-->
                    <div>
                        <h2 style="font-weight: bold">Editar</h2>
                    </div>

                    <!--CERRAR-->
                    <div>
                        <button wire:click="$set('editarFormulario.abierto', false)" wire:loading.attr="disabled">
                            <i style="cursor: pointer; color: #666666;" class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>
            </x-slot>
            <!--CONTENIDO-->
            <x-slot name="content">
                <div class="formulario">

                    <!--NOMBRE-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Nombre: <span class="campo_obligatorio">(Obligatorio)</span>
                            </p>
                            <input type="text" wire:model="editarFormulario.nombre">
                            @error('editarFormulario.nombre')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!--SLUG-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Slug: <span class="campo_obligatorio">(Obligatorio)</span>
                            </p>
                            <input type="text" wire:model="editarFormulario.slug">
                            @error('editarFormulario.slug')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!--DESCRIPCIÓN-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Descripción: <span class="campo_opcional">(Opcional)</span>
                            </p>
                            <textarea rows="2" wire:model="editarFormulario.descripcion"></textarea>
                            @error('editarFormulario.descripcion')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <div class="contenedor_pie_modal">
                    <button style="background-color: #009eff;" wire:click="$set('editarFormulario.abierto', false)"
                        wire:loading.attr="disabled" type="submit">Cancelar</button>

                    <button style="background-color: #ffa03d;" wire:click="actualizarTag" wire:loading.attr="disabled"
                        wire:target="actualizarTag" type="submit">Editar</button>
                </div>
            </x-slot>
        </x-jet-dialog-modal>
    @endif
</div>

<!--SCRIPT-->
@push('script')
    <script>
        Livewire.on('eliminarTagModal', tagId => {
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
                    Livewire.emitTo('administrador.tag.tag-livewire',
                        'eliminarTag', tagId);
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
