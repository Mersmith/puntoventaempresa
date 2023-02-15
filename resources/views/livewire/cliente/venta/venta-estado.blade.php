<div style="width: 100%">

    <!--CONTENEDOR ESTADO ORDEN VENTA-->
    <div class="contenedor_estado_orden_venta">
        <!--Recibido-->
        <div class="estado_orden_icono_texto">
            <div class="estado_orden_icono"
                style="background-color: {{ !$this->ventaEstado->estado == 1 || ($this->ventaEstado->estado >= 2 && $this->ventaEstado->estado != 5) ? 'var(--color-fondo-secundario-boton)' : 'var(--color-fondo-terciario-boton)' }}">
                <label>
                    <i class="fa-solid fa-dollar-sign"></i>
                </label>
            </div>
            <div>
                <p>Pagado</p>
            </div>
        </div>
        <div class="estado_orden_linea"
            style="background-color: {{ $this->ventaEstado->estado >= 2 && $this->ventaEstado->estado != 5 ? 'var(--color-fondo-secundario-boton)' : 'var(--color-fondo-terciario-boton)' }}">
        </div>
        <!--Ordenado-->
        <div class="estado_orden_icono_texto">
            <div class="estado_orden_icono"
                style="background-color: {{ $this->ventaEstado->estado >= 2 && $this->ventaEstado->estado != 5 ? 'var(--color-fondo-secundario-boton)' : 'var(--color-fondo-terciario-boton)' }}">
                <label>
                    <i class="fa-solid fa-list-check"></i>
                </label>
            </div>
            <div>
                <p>Alistado</p>
            </div>
        </div>
        <div class="estado_orden_linea"
            style="background-color: {{ $this->ventaEstado->estado >= 3 && $this->ventaEstado->estado != 5 ? 'var(--color-fondo-secundario-boton)' : 'var(--color-fondo-terciario-boton)' }}">
        </div>
        <!--Enviado-->
        <div class="estado_orden_icono_texto">
            <div class="estado_orden_icono"
                style="background-color: {{ $this->ventaEstado->estado >= 3 && $this->ventaEstado->estado != 5 ? 'var(--color-fondo-secundario-boton)' : 'var(--color-fondo-terciario-boton)' }}">
                <label>
                    <i class="fas fa-truck"></i>
                </label>
            </div>
            <div>
                <p>Enviado</p>
            </div>
        </div>
        <div class="estado_orden_linea"
            style="background-color: {{ $this->ventaEstado->estado >= 4 && $this->ventaEstado->estado != 5 ? 'var(--color-fondo-secundario-boton)' : 'var(--color-fondo-terciario-boton)' }}">
        </div>
        <!--Entregado-->
        <div class="estado_orden_icono_texto">
            <div class="estado_orden_icono"
                style="background-color: {{ $this->ventaEstado->estado >= 4 && $this->ventaEstado->estado != 5 ? 'var(--color-fondo-secundario-boton)' : 'var(--color-fondo-terciario-boton)' }}">
                <label>
                    <i class="fa-solid fa-box-open"></i>
                </label>
            </div>
            <div>
                <p>Entregado</p>
            </div>
        </div>
        <div class="estado_orden_linea"
            style="background-color: {{ $this->ventaEstado->estado >= 5 && $this->ventaEstado->estado != 6 ? 'var(--color-fondo-terciario-boton)' : 'var(--color-fondo-terciario-boton)' }}">
        </div>
        <!--Entregado-->
        <div class="estado_orden_icono_texto">
            <div class="estado_orden_icono"
                style="background-color: {{ $this->ventaEstado->estado >= 5 && $this->ventaEstado->estado != 6 ? 'red' : 'var(--color-fondo-terciario-boton)' }}">
                <label>
                    <i class="fa-solid fa-ban"></i>
                </label>
            </div>
            <div>
                <p>Cancelado</p>
            </div>
        </div>
    </div>

    <!--CONTENEDOR BOTOENES ESTADO ORDEN-->
    <div class="contenedor_botones_estado_orden">

        <!--BOTON ACTUALIZAR-->
        <button class="contenedor_estado_orden_venta_boton orden_boton_actualizar" wire:click="actualizarEstadoVenta"
            wire:loading.attr="disabled" wire:target="actualizarEstadoVenta">
            @if ($ventaEstado->estado == 1)
                <span>
                    ¿Cancelar compra?</span>
            @elseif($ventaEstado->estado == 5)
                <span> ¿Habilitar compra?</span>
            @endif
        </button>

    </div>

</div>
