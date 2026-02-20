@extends('plantilla')

@section('contenido')
@include('components/navbar')

<div class="container mt-5">
    <div class="row mt-2 justify-content-center">
        <div class="col mt-2 text-center">
            <div class="card p-3 rounded-3 mb-4">
                <h3 class="mb-4 text-center">Lista Empleados</h3>
                <div className="d-flex justify-content-center text-center mt-1 mb-2">
                    <a class="btn btn-success me-1" href="{{route('inicio')}}">
                        <i class="fa-solid fa-house"></i> Inicio
                    </a>
                    <a class="btn btn-primary" href="{{route('registro_empleado')}}">Registrar Empleado</a>
                </div>
                <div class="corner top-left">
                    <img src="{{asset('img/adorno04.png')}}" alt="Adorno esquina superior izquierda">
                </div>
                <div class="corner top-right">
                    <img src="{{asset('img/adorno03.png')}}" alt="Adorno esquina superior derecha">
                </div>
                <div class="corner bottom-left">
                    <img src="{{asset('img/adorno01.png')}}" alt="Adorno esquina inferior izquierda">
                </div>
                <div class="corner bottom-right">
                    <img src="{{asset('img/adorno02.png')}}" alt="Adorno esquina inferior derecha">
                </div>
                <div class="content mt-2">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Usuario</th>
                                <th>Rol</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datos as $usuario)
                            <tr>
                                <td>{{$usuario->id}}</td>
                                <td>{{$usuario->nombre}}</td>
                                <td>{{$usuario->apellido_pa}} {{$usuario->apellido_ma}}</td>
                                <td>{{$usuario->usuario}}</td>
                                <td>{{$usuario->roles}}</td>
                                <td>{{$usuario->email}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection