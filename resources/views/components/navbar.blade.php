<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{route('inicio')}}" id="navbar_brand">
            <img src="{{ asset('img/nombreMc.png') }}" height="50" width="175px" alt="Logo McDonald's">
        </a>

        <!-- Menú principal visible siempre al lado del logo -->
        <ul class="navbar-nav flex-row flex-grow-1">
            <li class="nav-item px-2">
                <a id="inicio" class="nav-link active" aria-current="page" href="{{route('inicio')}}">
                    <i class="fa-solid fa-house"></i> Inicio
                </a>
            </li>
            <li class="nav-item px-2">
                <a class="nav-link" href="{{route('lista_pedidos')}}">Pedidos</a>
            </li>
            <li class="nav-item px-2">
                <a class="nav-link" href="{{route('agregar')}}">Realizar Pedido</a>
            </li>
        </ul>

        <!-- Botón toggler para abrir offcanvas (solo para cerrar sesión) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Offcanvas solo con el botón cerrar sesión -->
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
            aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">McDonald's</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a href="{{route('cerrar_sesion')}}" class="btn btn-danger" id="btn_cerrar_sesion">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
