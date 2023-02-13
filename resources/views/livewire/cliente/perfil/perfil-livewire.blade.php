<div>

    <!--SEO-->
    @section('tituloPagina', 'Mi Perfil')
    @section('descripcion', 'En ' . env('APP_NAME') . ' tienes tu perfil para que administres tus compras.')

    <!--CONTENEDOR PAGINA CLIENTE-->
    <div class="contenedor_pagina_cliente">

        <!--TITULO-->
        <h2 class="cliente_paginas_titulo">Mis datos personales</h2>

        <!--FORMULARIO DATOS-->
        <div x-data class="formulario">

            <!--EMAIL-->
            <div class="contenedor_1_elementos_100">
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Email:
                        <!--<span class="campo_opcional">(Opcional)</span>-->
                    </p>
                    <input type="email" wire:model="email" disabled>
                    @error('email')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!--NOMBRE Y APELLIDO-->
            <div class="contenedor_2_elementos">
                <!--NOMBRE-->
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Nombre:
                        <!--<span class="campo_opcional">(Opcional)</span>-->
                    </p>
                    <input type="text" wire:model="nombre">
                    @error('nombre')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>

                <!--APELLIDO-->
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Apellido:
                        <!--<span class="campo_opcional">(Opcional)</span>-->
                    </p>
                    <input type="text" wire:model="apellido">
                    @error('apellido')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!--DNI Y RUC-->
            <div class="contenedor_2_elementos">
                <!--DNI-->
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">DNI:
                        <!--<span class="campo_opcional">(Opcional)</span>-->
                    </p>
                    <input type="number" wire:model="dni">
                    @error('dni')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>

                <!--RUC-->
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">RUC:
                        <!--<span class="campo_opcional">(Opcional)</span>-->
                    </p>
                    <input type="number" wire:model="ruc">
                    @error('ruc')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!--CELULAR Y PUNTOS-->
            <div class="contenedor_2_elementos">
                <!--CELULAR-->
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Celular:
                        <!--<span class="campo_opcional">(Opcional)</span>-->
                    </p>
                    <input type="tel" wire:model="celular">
                    @error('celular')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>

                <!--PUNTOS-->
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Puntos:
                        <!--<span class="campo_opcional">(Opcional)</span>-->
                    </p>
                    <input type="number" wire:model="puntos" disabled>
                    @error('puntos')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!--DIRECCIÓN-->
            <div class="contenedor_1_elementos_100">
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Dirección:
                        <!--<span class="campo_opcional">(Opcional)</span>-->
                    </p>
                    <textarea rows="2" wire:model="direccion"></textarea>
                    @error('direccion')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!--ENVIAR-->
            <div class="contenedor_1_elementos">
                <button wire:loading.attr="disabled" wire:target="editarCliente" wire:click="editarCliente">
                    Actualizar datos
                </button>
            </div>
        </div>

        <br>

        <!--TITULO-->
        <h2 class="cliente_paginas_titulo">CAMBIAR FOTO</h2>

        <!--FORMULARIO FOTO-->
        <div x-data class="formulario">

            <!--IMAGEN-->
            <div class="contenedor_1_elementos_100">
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Imagen:
                        <!--<span class="campo_opcional">(Opcional)</span>-->
                    </p>
                    <div class="contenedor_subir_imagen_sola contenedor_subir_imagen_sola_estilo_2">
                        @if ($editarImagen)
                            <img src="{{ $editarImagen->temporaryUrl() }}">
                            <span class="boton_imagen_eliminar" wire:click="$set('editarImagen', null)">
                                <i class="fa-solid fa-xmark"></i>
                            </span>
                        @elseif($imagen)
                            <img src="{{ Storage::url($cliente->imagen->imagen_ruta) }}">
                            <span class="boton_imagen_borrar" wire:click="$set('imagen', null)">
                                <i class="fa-solid fa-trash"></i>
                            </span>
                        @else
                            <img src="{{ asset('imagenes/perfil/sin_foto_perfil.png') }}">
                        @endif

                        <div class="opcion_cambiar_imagen">
                            <label for="imagen">
                                <div style="cursor: pointer;">
                                    Editar <i class="fa-solid fa-camera"></i>
                                </div>
                            </label>
                        </div>
                    </div>
                    <input type="file" wire:model="editarImagen" style="display: none" id="imagen">
                    @error('editarImagen')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!--ENVIAR-->
            <div class="contenedor_1_elementos">
                <button class="button_estilo_2" wire:loading.attr="disabled" wire:target="editarCliente"
                    wire:click="editarCliente">
                    Actualizar foto
                </button>
            </div>
        </div>

        <br>

        <!--TITULO-->
        <h2 class="cliente_paginas_titulo">CAMBIAR CONTRASEÑA</h2>

        <!--FORMULARIO CONTRASEÑA-->
        <div x-data class="formulario">

            <!--PASSWORD-->
            <div class="contenedor_1_elementos_100">
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Contraseña actual:
                        <!--<span class="campo_opcional">(Opcional)</span>-->
                    </p>
                    <input type="password" wire:model="password" disabled>
                    @error('password')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!--NUEVO PASSWORD-->
            <div class="contenedor_1_elementos_100">
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Nueva contraseña:
                        <!--<span class="campo_opcional">(Opcional)</span>-->
                    </p>
                    <input type="password" wire:model="editarPassword">
                    @error('editarPassword')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!--ENVIAR-->
            <div class="contenedor_1_elementos">
                <button class="button_estilo_2" wire:loading.attr="disabled" wire:target="editarCliente"
                    wire:click="editarCliente">
                    Cambiar contraseña
                </button>
            </div>

        </div>

    </div>

</div>

@push('script')
    <script>
        Livewire.on('eliminarClienteModal', () => {
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
                    Livewire.emitTo('cliente.perfil.perfil-livewire',
                        'eliminarCliente');
                    Swal.fire(
                        '¡Eliminado!',
                        'Eliminaste correctamente.',
                        'success'
                    )
                }
            })
        })
    </script>
@endpush
