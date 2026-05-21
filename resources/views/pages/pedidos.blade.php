@extends('plantilla')

@php
use App\Models\Usuario;

$idUsuario = session('sesionUsuario');
$usuario = Usuario::find($idUsuario);
@endphp

@section('contenido')
@include('components/navbar')

<div class="container mt-5">
    <div class="row mt-2 justify-content-center">
        <div class="col mt-4 text-center">
            <div class="card p-3 rounded-3 mb-4">
                <h3 class="fw-bold text-center">
                    {{ $usuario->nombre ?? '' }}
                </h3>
                <h3 class="mb-4 text-center">Lista de Pedidos</h3>

                <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap mt-1 mb-3">
                    <a class="btn" id="btn_inicio" href="{{route('inicio')}}">
                        <i class="fa-solid fa-house"></i> Inicio
                    </a>

                    <a class="btn" id="btn_realizar" href="{{route('agregar')}}">
                        <i class="fa-solid fa-burger"></i> Realizar Pedido
                    </a>

                    <a class="btn" id="btn_historial" href="{{route('historial')}}">
                        <i class="fa-solid fa-clock-rotate-left"></i> Historial Pedidos
                    </a>
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
                                        {{$pedido->entregado === 'Si' ? 'checked' : ''}}
                                        {{$pedido->impreso ? '' : 'disabled'}}>
                                </td>
                                <td>{{$pedido->fecha_pedido}}</td>
                                <td>
                                    @if(!$pedido->impreso)
                                    <a class="btn btn-warning"
                                        href="{{route('editar',$pedido->id)}}"
                                        id="editar-{{$pedido->id}}">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>

                                    <a class="btn btn-danger eliminar-btn"
                                        href="{{route('eliminar',$pedido->id)}}"
                                        data-id="{{$pedido->id}}">
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
                    body: JSON.stringify({
                        entregado
                    })
                })
                .then(async res => {
                    if (res.ok) {
                        if (entregado === 'Si' && fila) {
                            fila.remove();
                        }
                    } else {
                        const data = await res.json();
                        this.checked = !this.checked;
                        alert(data.message || 'Error al actualizar');
                    }
                });
        });
    });

    document.querySelectorAll('.imprimir-btn').forEach(button => {
        button.addEventListener('click', function() {

            const confirmar = confirm('¿Deseas imprimir este ticket?');
            if (!confirmar) return;

            const fila = this.closest('tr');

            const id = fila.children[0].innerText;
            const tipo = fila.children[1].innerText;
            const descripcion = fila.children[2].innerText;
            const total = fila.children[3].innerText;
            const metodo = fila.children[4].innerText;
            const fecha = fila.children[6].innerText;

            const ventana = window.open('', '_blank', 'width=300,height=600');

            ventana.document.write(`
            <html>
            <body style="font-family: monospace; text-align:center; padding:20px;">
                <h3>Ticket</h3>
                <p>#${id}</p>
                <hr>
                <p>${tipo}</p>
                <p>${descripcion}</p>
                <hr>
                <p>Total: $${total}</p>
                <p>${metodo}</p>
                <hr>
                <p>${fecha}</p>

                <script>
                    window.print();
                <\/script>
            </body>
            </html>
        `);

            ventana.document.close();

            fetch(`/pedidos/marcar-impreso/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(() => {
                    const editarBtn = fila.querySelector(`#editar-${id}`);
                    const eliminarBtn = fila.querySelector('.eliminar-btn');
                    const checkbox = fila.querySelector('.entregado-checkbox');

                    if (editarBtn) editarBtn.remove();
                    if (eliminarBtn) eliminarBtn.remove();
                    if (checkbox) checkbox.disabled = false;
                });
        });
    });

    document.querySelectorAll('.eliminar-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();

            const url = this.getAttribute('href');
            const confirmar = confirm('¿Estás seguro de eliminar este pedido?');

            if (confirmar) {
                window.location.href = url;
            }
        });
    });
</script>

@endsection