@extends('plantilla')

@section('contenido')
<div class="container mt-4">
    <form method="post" action="{{route('insertar_usuario')}}" class="row mb-3 justify-content-center">
        @csrf
        <div class="card justify-content-center" style="width: 25rem; background-color: rgba(255, 255, 255, 0.5);">
            <img class="mx-auto d-block" src="{{ asset('img/logo.png') }}" height="125" width="125px">
            <div class="card-body row justify-content-center">

                <h1 class="fw-bold text-center">Registro de Usuario</h1>

                <label class="fw-bold" for="nombre">Nombre</label>
                <input name="nombre" id="nombre" class="form-control mb-3" type="text" placeholder="Nombre" value="{{old('nombre')}}">
                @error('nombre')
                <p>{{$message}}</p>
                @enderror

                <label class="fw-bold" for="apellido">Apellido</label>
                <input name="apellido" id="apellido" class="form-control mb-3" type="text" placeholder="Apellido" value="{{old('apellido')}}">
                @error('apellido')
                <p>{{$message}}</p>
                @enderror

                <label class="fw-bold" for="usuario">Usuario</label>
                <input name="usuario" id="usuario" class="form-control mb-3" type="text" placeholder="Usuario" value="{{old('usuario')}}">
                @error('usuario')
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
                    <button type="submit" class="btn btn-success mb-2"><i class="fa-solid fa-chalkboard-user"></i> Registrar</button>
                    <br>
                    <a href="{{route('login')}}" class="btn btn-link-danger"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection