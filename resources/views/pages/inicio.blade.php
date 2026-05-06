@extends('plantilla')

@php
use App\Models\Usuario;

$idUsuario = session('sesionUsuario');
$usuario = Usuario::find($idUsuario);
@endphp

@section('contenido')
@include('components/navbar')
<div class="container mb-5">
    <div class="row mt-5">
        <div class="col mt-5">
            <div class="container mt-8">
                <div class="row mb-3 justify-content-center">
                    <div class="card justify-content-center" style="width: 33rem; background-color: rgba(255, 255, 255, 0.5);">
                        <img class="mx-auto d-block" src="{{ asset('img/logo.png') }}" height="125" width="125px">
                        <div class="card-body row justify-content-center">

                            <h1 class="fw-bold text-center">Bienvenido</h1>

                            <h3 class="fw-bold text-center mb-4">
                                {{ $usuario->nombre ?? '' }}
                            </h3>


                            <div className="d-flex justify-content-center text-center mt-2">
                                <a class="btn btn-success me-1"id="btn_pedidos" href="{{route('lista_pedidos')}}">Pedidos</a>
                                <a class="btn btn-info me-1" id="btn_realizar" href="{{route('agregar')}}">Realizar Pedido</a>
                                <a class="btn btn-secondary me-1" id="btn_historial" href="{{route('historial')}}">Historial Pedidos</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection