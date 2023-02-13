<div>
    <!--SEO-->
    @section('tituloPagina', 'Crear producto')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Crear producto</h2>
        </div>

        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.compra.index') }}">
                <i class="fa-solid fa-arrow-left"></i> Regresar</a>
        </div>
    </div>

    <!--CONTENEDOR CONTENIDO-->
    <div class="contenedor_administrador_contenido" x-data>


        <!--FORMULARIO-->
        <div x-data class="formulario contenedor_panel_producto_admin">

            <!--PROVEEDOR E IMPUESTO-->
            <div class="contenedor_2_elementos">
                <!--PROVEEDOR-->
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Proveedores: <span class="campo_obligatorio">(Obligatorio)</span></p>
                    <select wire:model="proveedor_id" x-bind:disabled="$wire.proveedor_id !== ''">
                        <option value="" selected disabled>Seleccione un proveedor</option>
                        @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                        @endforeach
                    </select>
                    @error('proveedor_id')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>

                <!--IMPUESTO-->
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Impuesto (%): <span class="campo_obligatorio">(Obligatorio)</span>
                    </p>
                    <input type="number" wire:model="impuesto">
                    @error('impuesto')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                    <span wire:click="$set('proveedor_id', '')">Cancelar</span>
                </div>
            </div>

            <!--PRODUCTOS Y PRECIO REAL-->
            <div class="contenedor_2_elementos">
                <!--PRODUCTOS-->
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Productos: <span class="campo_obligatorio">(Obligatorio)</span></p>
                    <select wire:model="producto">
                        <option value="" selected disabled>Seleccione un producto</option>
                        @foreach ($productos as $productoItem)
                            <option value="{{ $productoItem }}">{{ $productoItem->nombre }}</option>
                        @endforeach
                    </select class="campo_obligatorio">
                    @error('producto')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <!--PRECIO REAL-->
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Precio: <span class="campo_obligatorio">(Obligatorio)</span></p>
                    <input type="number" wire:model="precio">
                    @error('precio')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!--CANTIDAD-->
            <div class="contenedor_2_elementos">
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Cantidad: <span class="campo_obligatorio">(Obligatorio)</span></p>
                    <input type="number" wire:model="cantidad">
                    @error('cantidad')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!--ENVIAR-->
            <div class="contenedor_1_elementos">
                <button x-bind:disabled="!$wire.producto" wire:loading.attr="disabled" wire:target="agregarCarrito"
                    wire:click="agregarCarrito">
                    Agregar producto
                </button>
            </div>

        </div>

        <!--LISTA-->
        <div class="contenedor_panel_producto_admin">
            @if (count($carrito) > 0)
                <!--TABLA-->
                <div class="tabla_administrador py-4 overflow-x-auto">
                    <div class="inline-block min-w-full overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <tr>
                                <th>
                                    Nombre</th>
                                <th>
                                    Precio</th>
                                <th>
                                    Cantidad</th>
                                <th>
                                    SubTotal</th>                                
                                <th>
                                    Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($carrito as $carritoItem)
                                    <tr>
                                        <td>
                                            {{ $carritoItem['nombre'] }}
                                        </td>
                                        <td>
                                            {{ $carritoItem['precio'] }}
                                        </td>
                                        <td>
                                            {{ $carritoItem['cantidad'] }}
                                        </td>
                                        <td>
                                            {{ $carritoItem['subtotal_compra'] }}
                                        </td>
                                        <td>
                                            <a wire:click="eliminarProductoCarrito({{ $loop->index }})"> <span><i
                                                        class="fa-solid fa-pencil"></i></span>
                                                Eliminar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            @php
                                $array_columna = 'subtotal_compra';
                                $subTotal = array_sum(array_column($carrito, $array_columna));
                            @endphp
                            <tfoot>
                                <tr>
                                    <td style="text-align: right;" colspan="4">SUBTOTAL:</td>
                                    <td style="text-align: end;">
                                        ${{ $subTotal }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;" colspan="4">IMPUESTO ({{ $impuesto }}):</td>
                                    <td style="text-align: end;">
                                        ${{ ($subTotal * $impuesto) / 100 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;" colspan="4">TOTAL:</td>
                                    <td style="text-align: end;">
                                        ${{ number_format($subTotal + ($subTotal * $impuesto) / 100, 2) }}
                                    </td>
                                </tr>

                            </tfoot>

                        </table>

                        <!--ENVIAR-->
                        <div>
                            <button wire:loading.attr="disabled" wire:target="crearCompra" wire:click="crearCompra">
                                Crear compra
                            </button>
                        </div>
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

</div>
