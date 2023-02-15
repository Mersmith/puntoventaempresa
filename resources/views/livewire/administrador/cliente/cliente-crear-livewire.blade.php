<div>

    <!--SEO-->
    @section('tituloPagina', 'Crear cliente')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Crear cliente</h2>
        </div>

        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.cliente.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
        </div>
    </div>

    <!--CONTENEDOR ADMINISTRADOR PÁGINA-->
    <div class="contenedor_administrador_contenido">

        <!--FORMULARIOS-->
        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Nuevo cliente</h3>
            </div>

            <!--FORMULARIO-->
            <form wire:submit.prevent="crearCliente" x-data class="formulario">

                <!--EMAIL Y CONTRASEÑA-->
                <div class="contenedor_2_elementos">
                    <!--EMAIL-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Email:
                            <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <input type="email" wire:model="email">
                        @error('email')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--PASSWORD-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Contraseña:
                            <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <input type="password" wire:model="password">
                        @error('password')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--NOMBRE Y APELLIDO-->
                <div class="contenedor_2_elementos">
                    <!--NOMBRE-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Nombre:
                            <span class="campo_opcional">(Opcional)</span>
                        </p>
                        <input type="text" wire:model="nombre">
                        @error('nombre')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--APELLIDO-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Apellido:
                            <span class="campo_opcional">(Opcional)</span>
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
                            <span class="campo_opcional">(Opcional)</span>
                        </p>
                        <input type="number" wire:model="dni">
                        @error('dni')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--RUC-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">RUC:
                            <span class="campo_opcional">(Opcional)</span>
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
                            <span class="campo_opcional">(Opcional)</span>
                        </p>
                        <input type="tel" wire:model="celular">
                        @error('celular')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--PUNTOS-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Puntos:
                            <span class="campo_opcional">(Opcional)</span>
                        </p>
                        <input type="number" wire:model="puntos">
                        @error('puntos')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--DIRECCIÓN-->
                <div class="contenedor_1_elementos_100">
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Dirección:
                            <span class="campo_opcional">(Opcional)</span>
                        </p>
                        <textarea rows="2" wire:model="direccion"></textarea>
                        @error('direccion')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--IMAGEN-->
                <div class="contenedor_1_elementos_100">
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Imagen:
                            <span class="campo_opcional">(Opcional)</span>
                        </p>
                        <div class="contenedor_subir_imagen_sola contenedor_subir_imagen_sola_estilo_2">
                            @if ($imagen)
                                <img src="{{ $imagen->temporaryUrl() }}">
                                <span class="boton_imagen_eliminar" wire:click="$set('imagen', null)">
                                    <i class="fa-solid fa-xmark"></i>
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
                        <input type="file" wire:model="imagen" style="display: none" id="imagen">
                        @error('imagen')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--ENVIAR-->
                <div class="contenedor_1_elementos">
                    <input type="submit" value="Crear Cliente">
                </div>
            </form>
        </div>
    </div>

</div>
