<div>
    <!--SEO-->
    @section('tituloPagina', 'CREAR CUPÓN')

    @if (Session::has('message'))
        <div>{{ Session::get('message') }}</div>
    @endif

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Crear cupón</h2>
        </div>

        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.cupon.index') }}">
                <i class="fa-solid fa-arrow-left"></i> Regresar</a>
        </div>
    </div>

    <!--CONTENEDOR CONTENIDO-->
    <div class="contenedor_administrador_contenido">

        <!--FORMULARIO-->
        <form wire:submit.prevent="crearCupon" class="formulario">

            <!--CÓDIGO Y TIPO-->
            <div class="contenedor_2_elementos">
                <!--CÓDIGO-->
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Código Cupón: <span class="campo_obligatorio">(Obligatorio)</span>
                    </p>
                    <input type="text" placeholder="Código de Cupón" wire:model="codigo">
                    @error('codigo')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>

                <!--TIPO-->
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Tipo Cupón: <span class="campo_obligatorio">(Obligatorio)</span></p>
                    <select wire:model="tipo">
                        <option value="fijo" selected>Fijo</option>
                        <option value="porcentaje">Porcentaje</option>
                    </select>
                    @error('tipo')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!--DESCUENTO Y CARRITO MONTO-->
            <div class="contenedor_2_elementos">
                <!--DESCUENTO-->
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Descuento @if ($tipo == 'fijo')
                            en $:
                        @elseif($tipo == 'porcentaje')
                            en %:
                        @endif
                        <span class="campo_obligatorio">(Obligatorio)</span>
                    </p>
                    <input type="text" placeholder="Descuento de Cupón" wire:model="descuento">
                    @error('descuento')
                        <span class="campo_obligatorio">>{{ $message }}</span>
                    @enderror
                </div>

                <!--CARRITO MONTO-->
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Carrito Monto: <span class="campo_obligatorio">(Obligatorio)</span>
                    </p>
                    <input type="text" placeholder="Monto Carrito" wire:model="carrito_monto">
                    @error('carrito_monto')
                        <span class="campo_obligatorio">>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!--FECHA EXPIRACIÓN Y ENVIAR-->
            <div class="contenedor_2_elementos">
                <!--FECHA EXPIRACIÓN-->
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Fecha Expiración: <span
                            class="campo_obligatorio">(Obligatorio)</span></p>
                    <input type="date" placeholder="Monto de Expiración" wire:model="fecha_expiracion">
                    @error('fecha_expiracion')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>                
            </div>

            <!--ENVIAR-->
            <div class="contenedor_1_elementos">
                <input type="submit" value="Crear Cupón">
            </div>
        </form>
    </div>
</div>
