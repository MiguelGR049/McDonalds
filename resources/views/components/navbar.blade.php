@php
    $idUsuario = session('sesionUsuario');
    $usuario = \App\Models\Usuario::find($idUsuario);
@endphp

<nav class="navbar bg-body-tertiary fixed-top">
    <div class="container-fluid">

        <a class="navbar-brand d-flex align-items-center" href="{{route('inicio')}}" id="navbar_brand">
            <img src="{{ asset('img/nombreMc.png') }}" height="50" width="175px" alt="Logo McDonald's">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar">

            <div class="offcanvas-header">
                <h5 class="offcanvas-title">
                    <i class="fa-solid fa-burger"></i> McDonald's
                </h5>

                <button type="button" class="btn-close" id="x" data-bs-dismiss="offcanvas">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="offcanvas-body">

                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

                    <li class="nav-item mb-2">
                        <a id="inicio" class="nav-link active" href="{{route('inicio')}}">
                            <i class="fa-solid fa-house"></i> Inicio
                        </a>
                    </li>

                    @if($usuario && $usuario->esGerente())
                    <li class="nav-item mb-2">
                        <a class="nav-link" id="btn_empleados" href="{{route('empleados')}}">
                            <i class="fa-solid fa-users"></i> Lista Usuarios/Empleados
                        </a>
                    </li>
                    @endif

                </ul>

                <div class="mt-3">
                    <a href="{{route('cerrar_sesion')}}" class="btn w-100" id="btn_cerrar_sesion">
                        <i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión
                    </a>
                </div>

            </div>

        </div>

    </div>
</nav>