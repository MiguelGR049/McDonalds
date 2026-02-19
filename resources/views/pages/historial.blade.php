@extends('plantilla')

@section('contenido')
@include('components/navbar')

<div class="container mt-5">
    <div class="card p-4">

        <h3 class="mb-4 text-center">Pedidos Entregados</h3>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Total</th>
                    <th>Método</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datos as $pedido)
                <tr>
                    <td>{{$pedido->id}}</td>
                    <td>{{$pedido->tipo}}</td>
                    <td>{{$pedido->descripcion}}</td>
                    <td>{{$pedido->total_pagar}}</td>
                    <td>{{$pedido->metodo_pago}}</td>
                    <td>{{$pedido->usuario->nombre ?? 'N/A'}}</td>
                    <td>{{$pedido->usuario->roles ?? 'N/A'}}</td>
                    <td>{{$pedido->fecha_pedido}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
