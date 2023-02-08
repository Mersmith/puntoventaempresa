<header class="contenedor_navbar" x-data="sidebar" x-on:click.away="cerrarSidebar()"
    @resize.window="abiertoSidebar = false > 900">
    @php
        $json_menu = file_get_contents('menuAdministrador.json');
        $menuPrincipal = collect(json_decode($json_menu, true));
    @endphp
    <nav class="navbar">
        <!-- HAMBURGUESA -->
        <div x-on:click="toggleSidebar" class="contenedor_hamburguesa">
            <i class="fa-solid fa-bars" style="color: #666666;"></i>
        </div>
        <!-- LOGO -->
        <div class="contenedor_logo">
            <a href="{{ route('administrador.perfil') }}">
                <img src="{{ asset('imagenes/empresa/logo.png') }}" alt="" />
            </a>
        </div>
        <!-- MENU -->
        <div class="contenedor_menu_link">
            <div class="sidebar_logo">
                <a href="{{ route('administrador.perfil') }}">
                    <img src="{{ asset('imagenes/empresa/logo.png') }}" alt="" />
                </a>
                <i x-on:click="cerrarSidebar" style="cursor: pointer; color: #666666;" class="fa-solid fa-xmark"></i>
            </div>
            <hr>
            <div class="contenedor_administrador_sidebar">
                @auth
                    @if (Auth::user()->administrador->imagen_ruta)
                        <img style="width: 100px; height: 100px;"
                            src="{{ Storage::url(Auth::user()->administrador->imagen_ruta) }}">
                    @else
                        <img style="width: 100px; height: 100px;" src="{{ asset('imagenes/perfil/sin_foto_perfil.png') }}">
                    @endif

                    <p>{{ Auth::user()->administrador->nombre }}</p>
                    <span>{{ Auth::user()->email }}</span>

                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <a href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Cerrar') }}
                        </a>
                    </form>
                @else
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <i class="fa-solid fa-user" style="color: #666666;"></i>
                        </x-slot>
                        <x-slot name="content">
                            <x-jet-dropdown-link href="{{ route('login') }}">
                                {{ __('Entrar') }}
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ route('register') }}">
                                {{ __('Registrar') }}
                            </x-jet-dropdown-link>
                        </x-slot>
                    </x-jet-dropdown>
                @endauth
            </div>
            <hr>
            <!-- MENU-PRINCIPAL -->
            <div class="menu_principal" x-on:click.away="seleccionado = null">
                @foreach ($menuPrincipal as $key => $menu)
                    <div x-data="subMenu1" class="elementos_menu_principal">

                        <!--Menu Nombres-->
                        <div x-on:click="seleccionar({{ $key }})" class="menu_icono">
                            @if (count($menu['subMenu1']))
                                <a class="menu_nombre">{{ $menu['nombrePrincipal'] }}</a>
                                <i class="fa-solid fa-sort-down"></i>
                            @else
                                <a class="menu_nombre"
                                    href="{{ route($menu['nombrePrincipalUrl']) }}">{{ $menu['nombrePrincipal'] }}</a>
                                {{-- <a class="menu_nombre" href={{ $menu['nombrePrincipalUrl'] }}>{{ $menu['nombrePrincipal'] }}</a> --}}
                            @endif
                        </div>
                        <!--SubMenu1-->
                        <div :style="seleccionado == {{ $key }} && { display: 'block' }" x-transition
                            class="submenu_1" x-on:click.away="seleccionadoSubMenu1 = null">
                            @if (count($menu['subMenu1']))
                                @foreach ($menu['subMenu1'] as $keySub1 => $subMenu1)
                                    <div x-data="subMenu2" class="elementos_submenu_1">

                                        <!--SubMenu1 Nombres-->
                                        <div x-on:click="seleccionarSubMenu1({{ $keySub1 }})"
                                            class="menu_icono menu_icono_submenu"
                                            :style="seleccionadoSubMenu1 == {{ $keySub1 }} && { background: '#f3f4f6' }">
                                            @if (count($subMenu1['subMenu2']))
                                                <a class="submenu_nombre">{{ $subMenu1['nombreSubMenu1'] }}</a>
                                                <i class="fa-solid fa-sort-down"></i>
                                            @else
                                                <a class="submenu_nombre"
                                                    href="{{ route($subMenu1['nombreSubMenu1Url']) }}">{{ $subMenu1['nombreSubMenu1'] }}</a>
                                            @endif
                                        </div>

                                        <!--SubMenu2-->
                                        <div :style="seleccionadoSubMenu1 == {{ $keySub1 }} && { display: 'block' }"
                                            x-transition x-on:click.away="seleccionadoSubMenu2 = null"
                                            class="submenu_2">
                                            @if (count($subMenu1['subMenu2']))
                                                @foreach ($subMenu1['subMenu2'] as $keySub2 => $subMenu2)
                                                    <div x-data="subMenu3" class="elementos_submenu_2">

                                                        <!--SubMenu2 Nombres-->
                                                        <div x-on:click="seleccionarSubMenu2({{ $keySub2 }})"
                                                            class="menu_icono menu_icono_submenu"
                                                            :style="seleccionadoSubMenu2 == {{ $keySub2 }} &&
                                                            { background: '#f3f4f6' }">

                                                            @if (count($subMenu2['subMenu3']))
                                                                <a
                                                                    class="submenu_nombre">{{ $subMenu2['nombreSubMenu2'] }}</a>
                                                                <i class="fa-solid fa-sort-down"></i>
                                                            @else
                                                                <a class="submenu_nombre"
                                                                    href="{{ route($subMenu2['nombreSubMenu2Url']) }}">{{ $subMenu2['nombreSubMenu2'] }}</a>
                                                            @endif
                                                        </div>

                                                        <!--SubMenu3-->
                                                        <div :style="seleccionadoSubMenu2 == {{ $keySub2 }} &&
                                                        { display: 'block' }"
                                                            x-on:click.away="seleccionadoSubMenu3 = null" x-transition
                                                            class="submenu_3">
                                                            @if (count($subMenu2['subMenu3']))
                                                                @foreach ($subMenu2['subMenu3'] as $keySub3 => $subMenu3)
                                                                    <div x-data="subMenu4"
                                                                        class="elementos_submenu_3">

                                                                        <!--SubMenu3 Nombres-->
                                                                        <div x-on:click="seleccionarSubMenu3({{ $keySub3 }})"
                                                                            class="menu_icono menu_icono_submenu"
                                                                            :style="seleccionadoSubMenu3 ==
                                                                                {{ $keySub3 }} &&
                                                                                { background: '#f3f4f6' }">

                                                                            <a class="submenu_nombre"
                                                                                href="{{ route($subMenu3['nombreSubMenu3Url']) }}">{{ $subMenu3['nombreSubMenu3'] }}</a>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <hr>
            <!-- FIN MENU-PRINCIPAL -->
        </div>
        <!-- ICONOS -->
        <div class="contenedor_iconos">
            <i class="fa-solid fa-heart" style="color: #ffa03d;"></i>
        </div>
    </nav>
</header>

@push('script')
    <script>
        window.addEventListener("resize", function(event) {
            if (document.body.clientWidth < 900) {
                document.querySelector(".contenedor_menu_link").style.left = "-100%";

            } else {
                document.querySelector(".contenedor_menu_link").style.left = "0";
            }
        })

        function sidebar() {
            return {
                seleccionado: null,
                seleccionar(id) {
                    if (this.seleccionado == id) {
                        this.seleccionado = null;
                    } else {
                        this.seleccionado = id;
                    }
                },
                abiertoSidebar: false,
                toggleSidebar() {
                    this.abiertoSidebar = !this.abiertoSidebar
                    if (this.abiertoSidebar) {
                        document.querySelector(".contenedor_menu_link").style.left = "0";
                    } else {
                        document.querySelector(".contenedor_menu_link").style.left = "-100%";
                    }
                },
                /*abrirSidebar() {
                    if (this.abiertoSidebar) {
                        this.abiertoSidebar = false;
                        document.querySelector(".contenedor_menu_link").style.left = "-100%";
                    } else {
                        this.abiertoSidebar = true;
                        document.querySelector(".contenedor_menu_link").style.left = "0";
                    }
                },*/
                cerrarSidebar() {
                    let anchoPantalla = (window.innerWidth > 0) ? window.innerWidth : screen.width;
                    if (anchoPantalla < 900) {
                        this.abiertoSidebar = false;
                        document.querySelector(".contenedor_menu_link").style.left = "-100%";
                    }
                }
            }
        }

        function subMenu1() {
            return {
                seleccionadoSubMenu1: null,
                seleccionarSubMenu1(id) {
                    if (this.seleccionadoSubMenu1 == id) {
                        this.seleccionadoSubMenu1 = null;
                    } else {
                        this.seleccionadoSubMenu1 = id;
                    }
                },
            }
        }

        function subMenu2() {
            return {
                seleccionadoSubMenu2: null,
                seleccionarSubMenu2(id) {
                    if (this.seleccionadoSubMenu2 == id) {
                        this.seleccionadoSubMenu2 = null;
                    } else {
                        this.seleccionadoSubMenu2 = id;
                    }
                },
            }
        }

        function subMenu3() {
            return {
                seleccionadoSubMenu3: null,
                seleccionarSubMenu3(id) {
                    if (this.seleccionadoSubMenu3 == id) {
                        this.seleccionadoSubMenu3 = null;
                    } else {
                        this.seleccionadoSubMenu3 = id;
                    }
                },
            }
        }

        function subMenu4() {
            return {
                seleccionadoSubMenu4: null,
                seleccionarSubMenu4(id) {
                    if (this.seleccionadoSubMenu4 == id) {
                        this.seleccionadoSubMenu4 = null;
                    } else {
                        this.seleccionadoSubMenu4 = id;
                    }
                },
            }
        }
    </script>
@endpush
