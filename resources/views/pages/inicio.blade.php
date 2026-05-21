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


                            <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap mt-2">

                                <a class="btn btn-success" id="btn_pedidos" href="{{route('lista_pedidos')}}">
                                    <i class="fa-solid fa-list-check"></i> Pedidos
                                </a>

                                <a class="btn btn-info" id="btn_realizar" href="{{route('agregar')}}">
                                    <i class="fa-solid fa-burger"></i> Realizar Pedido
                                </a>

                                <a class="btn btn-secondary" id="btn_historial" href="{{route('historial')}}">
                                    <i class="fa-solid fa-clock-rotate-left"></i> Historial Pedidos
                                </a>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection