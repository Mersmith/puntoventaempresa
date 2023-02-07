<div x-data class="contenedor_producto_variacion_sin">

    <p>Tiene {{ $producto->stock }} variedad de productos</p>
    <p>Seleccione medida:</p>
    <select wire:model="medida_id">
        <option value="" selected disabled>Seleccione medida</option>
        @foreach ($medidas as $itemMedida)
            <option value="{{ $itemMedida->id }}">{{ $itemMedida->nombre }}</option>
        @endforeach
    </select>
    <br>
    <p>Seleccione color:</p>
    <select wire:model="color_id">
        <option value="" selected disabled>Seleccione color</option>
        @foreach ($colores as $itemColor)
            <option value="{{ $itemColor->id }}">{{ $itemColor->nombre }}</option>
        @endforeach
    </select>
    @if ($color_id)
        <div>
            <p><strong>Stock disponible:</strong>
                @if ($stockProducto)
                    {{ $stockProducto }}
                @else
                    0
                    {{-- $producto->stock --}}
                @endif
            </p>
        </div>
    @endif
    <br>
    <div class="contenedor_producto_variacion_controles_sin">
        <div>
            <x-jet-secondary-button disabled x-bind:disabled="$wire.cantidadCarrito <= 1" wire:loading.attr="disabled"
                wire:target="disminuir" wire:click="disminuir">-
            </x-jet-secondary-button>
            <span>{{ $cantidadCarrito }} </span>
            <x-jet-secondary-button x-bind:disabled="$wire.cantidadCarrito >= $wire.stockProducto"
                wire:loading.attr="disabled" wire:target="aumentar" wire:click="aumentar">+
            </x-jet-secondary-button>
        </div>
        <button x-bind:disabled="$wire.cantidadCarrito > $wire.stockProducto" x-bind:disabled="!$wire.stockProducto"
            wire:click="agregarProducto" wire:loading.attr="disabled" wire:target="agregarProducto"
            class="contenedor_producto_variacion_boton">
            Agregar al carrito
        </button>
    </div>
</div>
