@extends('plantilla')

@section('contenido')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col mt-5">
            <form method="post" action="{{route('login_usuario')}}" class="row justify-content-center" id="contenido">
                @csrf
                <div class="card justify-content-center" style="width: 25rem; background-color: rgba(255, 255, 255, 0.5);">
                    <img class="mx-auto d-block" src="{{ asset('img/logo.png') }}" height="125" width="125px">
                    <div class="card-body row justify-content-center">

                        <h1 class="fw-bold text-center">Inicio de Sesion</h1>

                        <label class="fw-bold" for="usuario">Usuario</label>
                        <input name="usuario" id="usuario" class="form-control mb-3" type="text" placeholder="Usuario" value="{{old('usuario')}}">
                        @error('usuario')
                        <p>{{$message}}</p>
                        @enderror

                        <label class="fw-bold" for="password">PIN</label>
                        <input name="password" id="password" class="form-control mb-3" type="password" placeholder="PIN">
                        @error('password')
                        <p>{{$message}}</p>
                        @enderror


                        <div class="col justify-content-center text-center">
                            <button type="submit" class="btn btn-success mb-2"><i class="fa-solid fa-right-to-bracket"></i> Iniciar</button>
                            <br>
                            <a href="{{route('registro')}}" class="btn btn-link-danger"><i class="fa-solid fa-chalkboard-user"></i> Registro</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection