@extends('plantilla')

@section('contenido')
@include('components/navbar')

<div class="container mt-5">
    <div class="row mt-5 justify-content-center">
        <div class="col mb-4 text-center">
            <form method="post" action="{{route('actualizar', $pedido->id)}}" class="row mt-5 justify-content-center">
                @method('PUT')
                @csrf

                <div class="card justify-content-center" style="width: 28rem; background-color: rgba(255, 255, 255, 0.6);">
                    <img class="mx-auto d-block" src="{{ asset('img/comida.png') }}" height="125" width="125px">

                    <div class="card-body">

                        <h1 class="fw-bold text-center">Editar Pedido</h1>

                        <input type="hidden" name="tipo" id="tipo" value="{{$pedido->tipo}}">
                        <input type="hidden" name="metodo_pago" id="metodo_pago" value="{{$pedido->metodo_pago}}">

                        <div class="mb-3 text-center">
                            <label class="fw-bold">Tipo</label>
                            <div class="d-flex justify-content-around mt-2">
                                <select name="tipo" id="tipo" class="form-control mb-3">
                                    <option value="">Selecciona un tipo</option>
                                    <option value="McTrio Mediano" {{ $pedido->tipo == 'McTrio Mediano' ? 'selected' : '' }}>McTrio Mediano</option>
                                    <option value="McTrio Grande" {{ $pedido->tipo == 'McTrio Grande' ? 'selected' : '' }}>McTrio Grande</option>
                                    <option value="Individual" {{ $pedido->tipo == 'Individual' ? 'selected' : '' }}>Individual</option>
                                </select>
                                @error('tipo')
                                <p>{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <label class="fw-bold">Descripción</label>
                        <div class="input-group mb-3">
                            <input name="descripcion" id="descripcion" class="form-control" type="text" readonly value="{{$pedido->descripcion}}">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#personalizarModal">
                                Editar
                            </button>
                        </div>

                        <label class="fw-bold">Total a Pagar</label>
                        <input name="total_pagar" id="total_pagar" class="form-control mb-3" type="text" readonly value="{{$pedido->total_pagar}}">

                        <div class="mb-3 text-center">
                            <label class="fw-bold">Método de Pago</label>
                            <div class="d-flex justify-content-around mt-2">

                                <div class="pago-card {{ $pedido->metodo_pago == 'Efectivo' ? 'seleccionado' : '' }}" onclick="seleccionarPago('Efectivo', this)">
                                    <img src="{{ asset('img/efectivo.png') }}" class="img-fluid">
                                    <p>Efectivo</p>
                                </div>

                                <div class="pago-card {{ $pedido->metodo_pago == 'Tarjeta' ? 'seleccionado' : '' }}" onclick="seleccionarPago('Tarjeta', this)">
                                    <img src="{{ asset('img/tarjeta.png') }}" class="img-fluid">
                                    <p>Tarjeta</p>
                                </div>

                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Actualizar</button>
                            <a class="btn btn-warning" href="{{route('lista_pedidos')}}">Cancelar</a>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="personalizarModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">

            <div class="modal-header">
                <h5 class="modal-title">Personalizar Pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <input type="hidden" id="hamburguesa">
                <input type="hidden" id="papas">
                <input type="hidden" id="refresco">

                <div class="mb-3">
                    <label class="fw-bold">Hamburguesa</label>
                    <div class="d-flex justify-content-around">
                        <img src="{{ asset('img/bigmac.png') }}" class="opcion-img" onclick="seleccionarOpcion('hamburguesa','Big Mac', this)">
                        <img src="{{ asset('img/cuarto.png') }}" class="opcion-img" onclick="seleccionarOpcion('hamburguesa','Cuarto de Libra', this)">
                        <img src="{{ asset('img/mcpollo.png') }}" class="opcion-img" onclick="seleccionarOpcion('hamburguesa','McPollo', this)">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Papas</label>
                    <div class="d-flex justify-content-around">
                        <img src="{{ asset('img/papas_chicas.png') }}" class="opcion-img" onclick="seleccionarOpcion('papas','Papas Chicas', this)">
                        <img src="{{ asset('img/papas_medianas.png') }}" class="opcion-img" onclick="seleccionarOpcion('papas','Papas Medianas', this)">
                        <img src="{{ asset('img/papas_grandes.png') }}" class="opcion-img" onclick="seleccionarOpcion('papas','Papas Grandes', this)">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Refresco</label>
                    <div class="d-flex justify-content-around">
                        <img src="{{ asset('img/coca.png') }}" class="opcion-img" onclick="seleccionarOpcion('refresco','Coca-Cola', this)">
                        <img src="{{ asset('img/sprite.png') }}" class="opcion-img" onclick="seleccionarOpcion('refresco','Sprite', this)">
                        <img src="{{ asset('img/fanta.png') }}" class="opcion-img" onclick="seleccionarOpcion('refresco','Fanta', this)">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Extras / Quitar</label>
                    <input type="text" id="extras" class="form-control">
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-success" onclick="generarDescripcion()">Aplicar</button>
            </div>

        </div>
    </div>
</div>

<script>
    function seleccionarTipo(tipoSeleccionado, elemento) {
        document.getElementById('tipo').value = tipoSeleccionado;
        document.querySelectorAll('.tipo-card').forEach(el => el.classList.remove('seleccionado'));
        elemento.classList.add('seleccionado');
    }

    function seleccionarPago(metodo, elemento) {
        document.getElementById('metodo_pago').value = metodo;
        document.querySelectorAll('.pago-card').forEach(el => el.classList.remove('seleccionado'));
        elemento.classList.add('seleccionado');
    }

    function seleccionarOpcion(campo, valor, elemento) {
        document.getElementById(campo).value = valor;
        elemento.parentElement.querySelectorAll('.opcion-img').forEach(el => el.classList.remove('seleccionado'));
        elemento.classList.add('seleccionado');
    }

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

        var modal = bootstrap.Modal.getInstance(document.getElementById('personalizarModal'));
        modal.hide();
    }
</script>

@endsection