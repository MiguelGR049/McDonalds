@extends('plantilla')

@section('contenido')
<div class="container mt-4">
    <form method="post" action="{{route('insertar_empleado')}}" class="row mb-3 justify-content-center">
        @csrf
        <div class="card justify-content-center" style="width: 25rem; background-color: rgba(255, 255, 255, 0.5);">
            <img class="mx-auto d-block" src="{{ asset('img/logo.png') }}" height="125" width="125px">
            <div class="card-body row justify-content-center">

                <h1 class="fw-bold text-center">Registro de Empleado</h1>

                <label class="fw-bold" for="nombre">Nombre</label>
                <input name="nombre" id="nombre" class="form-control mb-3" type="text" placeholder="Nombre" value="{{old('nombre')}}">
                @error('nombre')
                <p>{{$message}}</p>
                @enderror

                <label class="fw-bold" for="apellido_pa">Apellido Paterno</label>
                <input name="apellido_pa" id="apellido_pa" class="form-control mb-3" type="text" placeholder="Apellido Paterno" value="{{old('apellido_pa')}}">
                @error('apellido_pa')
                <p>{{$message}}</p>
                @enderror
                
                <label class="fw-bold" for="apellido_ma">Apellido Materno</label>
                <input name="apellido_ma" id="apellido_ma" class="form-control mb-3" type="text" placeholder="Apellido Materno" value="{{old('apellido_ma')}}">
                @error('apellido_ma')
                <p>{{$message}}</p>
                @enderror

                <label class="fw-bold" for="usuario">Usuario</label>
                <input name="usuario" id="usuario" class="form-control mb-3" type="text" placeholder="Usuario" value="{{old('usuario')}}">
                @error('usuario')
                <p>{{$message}}</p>
                @enderror
                
                <label class="fw-bold" for="roles">Puesto</label>
                <select name="roles" class="form-control" required>
                    <option value="cajero">Cajero</option>
                    <option value="gerente">Gerente</option>
                </select>
                @error('roles')
                <p>{{$message}}</p>
                @enderror

                <label class="fw-bold" for="correo">Correo Electrónico</label>
                <input name="email" id="email" class="form-control mb-3" type="email" placeholder="name@example.com" value="{{old('email')}}">
                @error('email')
                <p>{{$message}}</p>
                @enderror

                <label class="fw-bold" for="password">PIN</label>
                <input name="password" id="password" class="form-control mb-3" type="password" placeholder="PIN">
                @error('password')
                <p>{{$message}}</p>
                @enderror

                <div class="col justify-content-center text-center">
                    <button type="submit" class="btn btn-success mb-2">
                        <i class="fa-solid fa-chalkboard-user"></i> Registrar
                    </button>
                    <br>
                    <a href="{{route('inicio')}}" class="btn btn-link-danger">
                        <i class="fa-solid fa-right-to-bracket"></i> Cancelar
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection