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
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" style="background-color: rgba(145, 128, 128, 0.5);">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">McDonald's</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a id="inicio" class="nav-link active" href="{{route('inicio')}}">
                            <i class="fa-solid fa-house"></i> Inicio
                        </a>
                    </li>

                    @if($usuario && $usuario->esGerente())
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('empleados')}}">Lista Empleados</a>
                    </li>
                    @endif
                </ul>

                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a href="{{route('cerrar_sesion')}}" class="btn btn-danger" id="btn_cerrar_sesion">
                            Cerrar Sesión
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>