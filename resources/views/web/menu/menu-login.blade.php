@php
    $json_menu_cliente = file_get_contents('menuCliente.json');
    $menuPrincipalCliente = collect(json_decode($json_menu_cliente, true));
@endphp

@auth
    <!-- Settings Dropdown -->
    <div class="ml-3 relative">
        <x-jet-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button
                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                    @if (Auth::user()->rol == 'administrador')
                        @if (Auth::user()->administrador && Auth::user()->administrador)
                            <img class="h-8 w-8 rounded-full object-cover"
                                src="{{ Storage::url(Auth::user()->administrador->imagen_ruta) }}"
                                alt="{{ Auth::user()->administrador->nombre }}" />
                        @else
                            <img class="h-8 w-8 rounded-full object-cover"
                                src="{{ asset('imagenes/perfil/sin_foto_perfil.png') }}" />
                        @endif
                    @else
                        @if (Auth::user()->cliente && Auth::user()->cliente->imagen)
                            <img class="h-8 w-8 rounded-full object-cover"
                                src="{{ Storage::url(Auth::user()->cliente->imagen->imagen_ruta) }}"
                                alt="{{ Auth::user()->cliente->nombre }}" />
                        @else
                            <img class="h-8 w-8 rounded-full object-cover"
                                src="{{ asset('imagenes/perfil/sin_foto_perfil.png') }}" />
                        @endif
                    @endif
                </button>
            </x-slot>
            <x-slot name="content">
                <!-- Menu Cliente -->
                @if (Auth::user()->rol == 'administrador')
                    <x-jet-dropdown-link href="">
                        {{ __('Perfil') }}
                    </x-jet-dropdown-link>

                    <x-jet-dropdown-link href="#">
                        {{ __('Ventas') }}
                    </x-jet-dropdown-link>
                @else
                    @foreach ($menuPrincipalCliente as $key => $menu)
                        <x-jet-dropdown-link href="{{ route($menu['nombrePrincipalUrl']) }}">
                            {{ __($menu['nombrePrincipal']) }}
                        </x-jet-dropdown-link>
                    @endforeach
                @endif

                <div class="border-t border-gray-100"></div>

                <!-- Cerrar Sesión -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Cerrar') }}
                    </x-jet-dropdown-link>
                </form>
            </x-slot>
        </x-jet-dropdown>
    </div>
@else
    <x-jet-dropdown align="right" width="48">
        <x-slot name="trigger">
            <i class="fa-solid fa-user" style="color: #666666;"></i>
        </x-slot>
        <x-slot name="content">
            <x-jet-dropdown-link href="">
                {{ __('Entrar') }}
            </x-jet-dropdown-link>
        </x-slot>
    </x-jet-dropdown>
@endauth
