@extends('plantilla')

@section('contenido')
@include('components/navbar')

<div class="container mt-5">
    <div class="row mt-2 justify-content-center">
        <div class="col mt-2 text-center">
            <div class="card p-3 rounded-3 mb-4">
                <h3 class="mb-4 text-center">Lista de Pedidos</h3>

                <div class="d-flex justify-content-center text-center mt-1">
                    <a class="btn btn-success me-1" href="{{route('inicio')}}">
                        <i class="fa-solid fa-house"></i> Inicio
                    </a>
                    <a class="btn btn-info me-1" href="{{route('agregar')}}">Realizar Pedido</a>
                    <a class="btn btn-secondary me-1" href="{{route('historial')}}">Historial Pedidos</a>
                </div>

                <div class="content mt-4">
                    <table class="table table-hover p-3 rounded-3">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>Descripción</th>
                                <th>Total</th>
                                <th>Método de Pago</th>
                                <th>Entregado</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datos as $pedido)
                            <tr id="pedido-{{$pedido->id}}">
                                <td>{{$pedido->id}}</td>
                                <td>{{$pedido->tipo}}</td>
                                <td>{{$pedido->descripcion}}</td>
                                <td>{{$pedido->total_pagar}}</td>
                                <td>{{$pedido->metodo_pago}}</td>
                                <td>
                                    <input type="checkbox"
                                           class="form-check-input entregado-checkbox"
                                           data-id="{{$pedido->id}}"
                                           {{$pedido->entregado === 'Si' ? 'checked' : ''}}>
                                </td>
                                <td>{{$pedido->fecha_pedido}}</td>
                                <td>
                                    @if(!$pedido->impreso)
                                        <a class="btn btn-warning"
                                           href="{{route('editar',$pedido->id)}}"
                                           id="editar-{{$pedido->id}}">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>

                                        <a class="btn btn-danger"
                                           href="{{route('eliminar',$pedido->id)}}"
                                           id="eliminar-{{$pedido->id}}">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </a>
                                    @endif

                                    <button class="btn btn-primary imprimir-btn"
                                            data-id="{{$pedido->id}}">
                                        <i class="fa-solid fa-print"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.entregado-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function() {

        const id = this.getAttribute('data-id');
        const entregado = this.checked ? 'Si' : 'No';
        const fila = document.getElementById(`pedido-${id}`);

        fetch(`/pedidos/actualizar-entregado/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ entregado })
        })
        .then(res => {
            if (res.ok) {
                if (entregado === 'Si' && fila) {
                    fila.remove();
                }
            } else {
                this.checked = !this.checked;
                alert('Error al actualizar');
            }
        });
    });
});

document.querySelectorAll('.imprimir-btn').forEach(button => {
    button.addEventListener('click', function() {

        const id = this.getAttribute('data-id');
        alert('Imprimiendo ticket...');

        fetch(`/pedidos/marcar-impreso/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(res => {
            if (res.ok) {
                const editarBtn = document.getElementById(`editar-${id}`);
                const eliminarBtn = document.getElementById(`eliminar-${id}`);

                if (editarBtn) editarBtn.remove();
                if (eliminarBtn) eliminarBtn.remove();
            } else {
                alert('Error al marcar como impreso');
            }
        });
    });
});
</script>

@endsection