@extends('plantilla')

@section('contenido')
@include('components/navbar')
<div class="container mt-5">
    <div class="row mt-5 justify-content-center">
        <div class="col mb-4 text-center">
            <form method="post" action="{{route('actualizar', $pedido->id)}}" class="row mt-5 justify-content-center">
                @method('PUT')
                @csrf
                <div class="card justify-content-center" style="width: 25rem; background-color: rgba(255, 255, 255, 0.5);">
                    <img class="mx-auto d-block" src="{{ asset('img/comida.png') }}" height="125" width="125px">
                    <div class="card-body row justify-content-center">

                        <h1 class="fw-bold text-center">Editar Pedido</h1>

                        <label class="fw-bold" for="tipo">Tipo</label>
                        <select name="tipo" id="tipo" class="form-control mb-3">
                            <option value="">Selecciona un tipo</option>
                            <option value="McTrio Mediano" {{ $pedido->tipo == 'McTrio Mediano' ? 'selected' : '' }}>McTrio Mediano</option>
                            <option value="McTrio Grande" {{ $pedido->tipo == 'McTrio Grande' ? 'selected' : '' }}>McTrio Grande</option>
                            <option value="Individual" {{ $pedido->tipo == 'Individual' ? 'selected' : '' }}>Individual</option>
                        </select>
                        @error('tipo')
                        <p>{{$message}}</p>
                        @enderror

                        <label class="fw-bold" for="descripcion">Descripción</label>
                        <div class="input-group mb-3">
                            <input name="descripcion" id="descripcion" class="form-control" type="text" placeholder="Descripción del pedido" readonly value="{{$pedido->descripcion}}">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#personalizarModal">
                                Editar
                            </button>
                        </div>
                        @error('descripcion')
                        <p>{{$message}}</p>
                        @enderror

                        <label class="fw-bold" for="total_pagar">Total a Pagar</label>
                        <input name="total_pagar" id="total_pagar" class="form-control mb-3" type="text" placeholder="Total a Pagar" value="{{$pedido->total_pagar}}" readonly>
                        @error('total_pagar')
                        <p>{{$message}}</p>
                        @enderror

                        <label class="fw-bold" for="metodo_pago">Método de Pago</label>
                        <select name="metodo_pago" id="metodo_pago" class="form-control mb-3">
                            <option value="">Selecciona un método</option>
                            <option value="Efectivo" {{ $pedido->metodo_pago == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                            <option value="Tarjeta" {{ $pedido->metodo_pago == 'Tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                        </select>
                        @error('metodo_pago')
                        <p>{{$message}}</p>
                        @enderror

                        <div class="col justify-content-center text-center">
                            <button type="submit" class="btn btn-success mb-2">Actualizar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para personalizar pedido -->
<div class="modal fade" id="personalizarModal" tabindex="-1" aria-labelledby="personalizarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h5 class="modal-title" id="personalizarLabel">Personalizar Pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <!-- Hamburguesa -->
                <div class="mb-3">
                    <label class="fw-bold">Hamburguesa</label>
                    <select id="hamburguesa" class="form-select">
                        <option value="">Seleccionar</option>
                        <option value="Big Mac">Big Mac</option>
                        <option value="Cuarto de Libra">Cuarto de Libra</option>
                        <option value="McPollo">McPollo</option>
                    </select>
                </div>

                <!-- Papas -->
                <div class="mb-3">
                    <label class="fw-bold">Papas</label>
                    <select id="papas" class="form-select">
                        <option value="">Seleccionar</option>
                        <option value="Papas Chicas">Papas Chicas</option>
                        <option value="Papas Medianas">Papas Medianas</option>
                        <option value="Papas Grandes">Papas Grandes</option>
                        <option value="McPatatas">McPatatas</option>
                    </select>
                </div>

                <!-- Refresco -->
                <div class="mb-3">
                    <label class="fw-bold">Sabor de Refresco</label>
                    <select id="refresco" class="form-select">
                        <option value="">Seleccionar</option>
                        <option value="Coca-Cola">Coca-Cola</option>
                        <option value="Sprite">Sprite</option>
                        <option value="Fanta">Fanta</option>
                        <option value="Agua">Agua</option>
                    </select>
                </div>

                <!-- Extras -->
                <div class="mb-3">
                    <label class="fw-bold">Extras / Quitar</label>
                    <input type="text" id="extras" class="form-control" placeholder="Ej: Sin cebolla, extra queso">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" onclick="generarDescripcion()">Aplicar</button>
            </div>
        </div>
    </div>
</div>

<!-- Script para actualizar descripción y total -->
<script>
    function generarDescripcion() {
        const tipo = document.getElementById('tipo').value.toLowerCase();
        const hamburguesa = document.getElementById('hamburguesa').value;
        const papas = document.getElementById('papas').value;
        const refresco = document.getElementById('refresco').value;
        const extras = document.getElementById('extras').value;

        let descripcion = '';
        let precio = 0;

        if (tipo.includes('mctrio')) {
            descripcion += `Combo ${tipo} con ${hamburguesa}, ${papas}, ${refresco}`;
            precio += 80;
        } else {
            if (hamburguesa) {
                descripcion += `Hamburguesa: ${hamburguesa}`;
                precio += 45;
            }
            if (papas) {
                descripcion += descripcion ? `, ` : '';
                descripcion += `Papas: ${papas}`;
                precio += 20;
            }
            if (refresco) {
                descripcion += descripcion ? `, ` : '';
                descripcion += `Refresco: ${refresco}`;
                precio += 15;
            }
        }

        if (extras) {
            descripcion += ` (${extras})`;
        }

        document.getElementById('descripcion').value = descripcion;
        document.getElementById('total_pagar').value = precio;

        // Cierra el modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('personalizarModal'));
        modal.hide();
    }
    document.addEventListener("DOMContentLoaded", () => {
        const tipoSelect = document.getElementById('tipo');
        const hamburguesa = document.getElementById('hamburguesa');
        const papas = document.getElementById('papas');
        const refresco = document.getElementById('refresco');

        function actualizarOpciones() {
            const tipo = tipoSelect.value;

            if (tipo === 'Individual') {
                // Solo permitir una opción activa a la vez
                hamburguesa.disabled = false;
                papas.disabled = false;
                refresco.disabled = false;

                [hamburguesa, papas, refresco].forEach(select => {
                    select.addEventListener('change', () => {
                        const selects = [hamburguesa, papas, refresco];
                        let selected = selects.find(s => s.value !== '');
                        selects.forEach(s => {
                            if (s !== selected) s.disabled = true;
                        });
                        if (!selected) {
                            selects.forEach(s => s.disabled = false);
                        }
                    });
                });

            } else {
                // Combo: todos activos
                [hamburguesa, papas, refresco].forEach(select => {
                    select.disabled = false;
                });
            }
        }

        tipoSelect.addEventListener('change', actualizarOpciones);
        actualizarOpciones(); // Llamada inicial por si ya hay un valor
    });
</script>
@endsection
