@extends('plantilla')

@section('contenido')

<div class="container mt-4">

    <form method="post" action="{{route('insertar_empleado')}}" class="row mb-3 justify-content-center">
        @csrf

        <div class="card justify-content-center" style="width: 28rem; background-color: rgba(255, 255, 255, 0.5);">

            <img class="mx-auto d-block mt-3" src="{{ asset('img/logo.png') }}" height="125" width="125px">

            <div class="card-body row justify-content-center">

                <h1 class="fw-bold text-center mb-4">
                    <i class="fa-solid fa-user-plus"></i> Registro de Empleado
                </h1>

                <label class="fw-bold" for="nombre">
                    <i class="fa-solid fa-user"></i> Nombre
                </label>

                <input
                    name="nombre"
                    id="nombre"
                    class="form-control mb-3"
                    type="text"
                    placeholder="Nombre"
                    value="{{old('nombre')}}"
                >

                @error('nombre')
                <p class="text-danger fw-bold">{{$message}}</p>
                @enderror


                <label class="fw-bold" for="apellido_pa">
                    <i class="fa-solid fa-id-card"></i> Apellido Paterno
                </label>

                <input
                    name="apellido_pa"
                    id="apellido_pa"
                    class="form-control mb-3"
                    type="text"
                    placeholder="Apellido Paterno"
                    value="{{old('apellido_pa')}}"
                >

                @error('apellido_pa')
                <p class="text-danger fw-bold">{{$message}}</p>
                @enderror


                <label class="fw-bold" for="apellido_ma">
                    <i class="fa-solid fa-id-card"></i> Apellido Materno
                </label>

                <input
                    name="apellido_ma"
                    id="apellido_ma"
                    class="form-control mb-3"
                    type="text"
                    placeholder="Apellido Materno"
                    value="{{old('apellido_ma')}}"
                >

                @error('apellido_ma')
                <p class="text-danger fw-bold">{{$message}}</p>
                @enderror


                <label class="fw-bold" for="usuario">
                    <i class="fa-solid fa-at"></i> Usuario
                </label>

                <input
                    name="usuario"
                    id="usuario"
                    class="form-control mb-3"
                    type="text"
                    placeholder="Usuario"
                    value="{{old('usuario')}}"
                >

                @error('usuario')
                <p class="text-danger fw-bold">{{$message}}</p>
                @enderror


                <label class="fw-bold" for="roles">
                    <i class="fa-solid fa-briefcase"></i> Puesto
                </label>

                <select name="roles" class="form-control mb-3" required>
                    <option value="cajero">Cajero</option>
                    <option value="gerente">Gerente</option>
                </select>

                @error('roles')
                <p class="text-danger fw-bold">{{$message}}</p>
                @enderror


                <label class="fw-bold" for="correo">
                    <i class="fa-solid fa-envelope"></i> Correo Electrónico
                </label>

                <input
                    name="email"
                    id="email"
                    class="form-control mb-3"
                    type="email"
                    placeholder="name@example.com"
                    value="{{old('email')}}"
                >

                @error('email')
                <p class="text-danger fw-bold">{{$message}}</p>
                @enderror


                <label class="fw-bold" for="password">
                    <i class="fa-solid fa-lock"></i> PIN
                </label>

                <input
                    name="password"
                    id="password"
                    class="form-control mb-4"
                    type="password"
                    placeholder="PIN"
                >

                @error('password')
                <p class="text-danger fw-bold">{{$message}}</p>
                @enderror


                <div class="d-flex justify-content-center gap-2 flex-wrap">

                    <button type="submit" class="btn" id="btn_registrar">
                        <i class="fa-solid fa-chalkboard-user"></i> Registrar
                    </button>

                    <a href="{{route('inicio')}}" class="btn" id="btn_cancelar">
                        <i class="fa-solid fa-xmark"></i> Cancelar
                    </a>

                </div>

            </div>
        </div>
    </form>

</div>

@endsection