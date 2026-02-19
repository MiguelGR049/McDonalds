@extends('plantilla')

@section('contenido')
@include('components/navbar')

<div class="container mt-5">
    <div class="row mt-5 justify-content-center">
        <div class="col mt-4 text-center">
            <div class="row mt-5 justify-content-center">
                <div class="card p-3 rounded-3 mb-4" style="background-color: rgba(255, 255, 255, 0.5);">
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
                    <div class="content">
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
                                        <input type="checkbox" class="form-check-input entregado-checkbox"
                                            data-id="{{$pedido->id}}"
                                            {{$pedido->entregado === 'Si' ? 'checked' : ''}}>
                                    </td>
                                    <td>{{$pedido->fecha_pedido}}</td>
                                    <td>
                                        <a class="btn btn-warning editar-btn"
                                            href="{{route('editar',$pedido->id)}}"
                                            id="editar-{{$pedido->id}}" 
                                            style="{{ $pedido->impreso ? 'display: none;' : '' }}">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <a class="btn btn-danger" href="{{route('eliminar',$pedido->id)}}">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </a>
                                        <button class="btn btn-primary imprimir-btn" data-id="{{$pedido->id}}">
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
</div>

<script>
    // Actualiza el campo "entregado" al marcar/desmarcar checkbox
    document.querySelectorAll('.entregado-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const id = this.getAttribute('data-id');
            const entregado = this.checked ? 'Si' : 'No';

            fetch(`/pedidos/actualizar-entregado/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    entregado
                })
            }).then(res => {
                if (!res.ok) {
                    alert('Error al actualizar');
                    this.checked = !this.checked;
                }
            });
        });
    });

    // Marca pedido como impreso y oculta botón editar
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
            }).then(res => {
                if (res.ok) {
                    const editarBtn = document.getElementById(`editar-${id}`);
                    if (editarBtn) editarBtn.remove();
                } else {
                    alert('Error al marcar como impreso');
                }
            });
        });
    });
</script>

@endsection
