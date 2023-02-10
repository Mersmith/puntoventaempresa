<div>
    @section('tituloPagina', 'EDITAR CUPÓN')
    <!--Titulo-->
    <h2 class="contenedor_paginas_titulo">EDITARCUPÓN</h2>
    <!--Boton regresar-->
    <div class="contenedor_boton_titulo">
        <a href="{{ route('administrador.cupones.index') }}">
            <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
    </div>
    <div class="contenedor_paginas_administrador">
        <form wire:submit.prevent="actualizarCupon" class="formulario">
            <!--Codigo-->
            <div class="contenedor_1_elementos">
                <label class="label_principal">
                    <p class="estilo_nombre_input">Código Cupón: </p>
                    <input type="text" placeholder="Código de Cupón" wire:model="codigo">
                    @error('codigo')
                        <span>{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <!--Tipo-->
            <div class="contenedor_1_elementos">
                <label class="label_principal">
                    <p class="estilo_nombre_input">Tipo Cupón: </p>
                    <select wire:model="tipo">
                        <option value="fijo" selected>Fijo</option>
                        <option value="porcentaje">Porcentaje</option>
                    </select>
                    @error('tipo')
                        <span>{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <!--Descuento-->
            <div class="contenedor_1_elementos">
                <label class="label_principal">
                    <p class="estilo_nombre_input">Descuento @if ($tipo == 'fijo')
                            en $:
                        @elseif($tipo == 'porcentaje')
                            en %:
                        @endif
                    </p>
                    <input type="text" placeholder="Descuento de Cupón" wire:model="descuento">
                    @error('descuento')
                        <span>{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <!--Carrito Monto-->
            <div class="contenedor_1_elementos">
                <label class="label_principal">
                    <p class="estilo_nombre_input">Carrito Monto: </p>
                    <input type="text" placeholder="Monto Carrito" wire:model="carrito_monto">
                    @error('carrito_monto')
                        <span>{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <!--Fecha-->
            <div class="contenedor_1_elementos">
                <label class="label_principal">
                    <p class="estilo_nombre_input">Fecha Expiración: </p>
                    <input type="date" placeholder="Monto de Expiración" wire:model="fecha_expiracion">
                    @error('fecha_expiracion')
                        <span>{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <!--Enviar-->
            <div class="contenedor_1_elementos">
                <input type="submit" value="Editar Cupón">
            </div>
        </form>

    </div>

</div>
