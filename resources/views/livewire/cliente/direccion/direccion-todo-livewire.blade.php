<div>
    <!--SEO-->
    @section('tituloPagina', 'PERFIL')

    <!--CONTENEDOR PAGINA PERFIL-->
    <div class="contenedor_pagina_perfil">

        <!--TITULO-->
        <h2 class="cliente_paginas_titulo">MIS DATOS PERSONALES</h2>

        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_cliente">
            <a href="{{ route('cliente.direccion.crear') }}">
                Crear Dirección <i class="fa-solid fa-square-plus"></i></a>
        </div>

        @if ($direcciones->count())
            @foreach ($direcciones as $key => $direccionItem)
                <div
                    style="display: flex; padding: 10px; border: 1.5px solid #cfd3d9; margin: 10px 0px; border-radius: 5px;">
                    <div style="margin-right: 5px;"><i class="fa-solid fa-location-dot"></i></div>
                    <div style="width: 100%;">
                        <p>{{ $direccionItem->nombres }}</p>
                        <p>{{ $direccionItem->celular }}</p>
                        <p>{{ $direccionItem->direccion }}</p>
                        <p>{{ $direccionItem->referencia }}</p>
                        <p style="font-weight: 600">{{ $direccionItem->departamento_nombre }} /
                            {{ $direccionItem->provincia_nombre }} /
                            {{ $direccionItem->distrito_nombre }}, {{ $direccionItem->codigo_postal }}</p>

                        <a href="{{ route('cliente.direccion.editar', $direccionItem) }}"
                            style="font-weight: 700; color: #009eff;">Editar</a>
                        <button wire:click="establecerPrincipal({{ $direccionItem->id }} )"
                            wire:loading.attr="disabled" wire:target="establecerPrincipal"
                            style="font-weight: 700; color: #ffa03d; display: {{ $key == 0 ? 'none' : '' }};">Establecer
                            principal</button>
                    </div>
                    <div style="margin-right: 5px;"><i
                            wire:click="$emit('eliminarDireccionModal', '{{ $direccionItem->id }}')"
                            class="fa-solid fa-trash" style="color: red; cursor: pointer;"></i></div>
                </div>
            @endforeach
        @else
            <div class="contenedor_no_existe_elementos">
                <p>No tienes direcciones.</p>
                <i class="fa-solid fa-spinner"></i>
            </div>
        @endif

    </div>

</div>

@push('script')
    <script>
        Livewire.on('eliminarDireccionModal', direccionId => {
            Swal.fire({
                title: '¿Quieres eliminar?',
                text: "No podrás recupar esta dirección.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('cliente.direccion.direccion-todo-livewire',
                        'eliminarDireccion', direccionId);
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
