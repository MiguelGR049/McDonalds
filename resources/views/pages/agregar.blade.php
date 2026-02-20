@extends('plantilla')

@section('contenido')
@include('components/navbar')
<div class="container mt-5">
    <div class="row mt-5 justify-content-center">
        <div class="col mb-4 text-center">
            <form method="post" action="{{route('insertar')}}" class="row mt-5 justify-content-center">
                @csrf
                <div class="card justify-content-center" style="width: 25rem; background-color: rgba(255, 255, 255, 0.5);">
                    <img class="mx-auto d-block" src="{{ asset('img/comida.png') }}" height="125" width="125px">
                    <div class="card-body row justify-content-center">

                        <h1 class="fw-bold text-center">Realizar Pedido</h1>

                        <label class="fw-bold" for="tipo">Tipo</label>
                        <select name="tipo" id="tipo" class="form-control mb-3" onchange="ajustarOpcionesModal()">
                            <option value="">Selecciona el tipo</option>
                            <option value="McTrio Mediano">McTrio Mediano</option>
                            <option value="McTrio Grande">McTrio Grande</option>
                            <option value="Individual">Individual</option>
                        </select>
                        @error('tipo')
                        <p>{{$message}}</p>
                        @enderror

                        <label class="fw-bold" for="descripcion">Descripción</label>
                        <div class="input-group mb-3">
                            <input name="descripcion" id="descripcion" class="form-control" type="text" placeholder="Descripción del pedido" readonly value="{{old('descripcion')}}">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#personalizarModal">
                                Personalizar
                            </button>
                        </div>
                        @error('descripcion')
                        <p>{{$message}}</p>
                        @enderror

                        <label class="fw-bold" for="total_pagar">Total a Pagar</label>
                        <input name="total_pagar" id="total_pagar" class="form-control mb-3" type="text" placeholder="Total a Pagar" value="{{old('total_pagar')}}" readonly>
                        @error('total_pagar')
                        <p>{{$message}}</p>
                        @enderror

                        <label class="fw-bold" for="metodo_pago">Método de Pago</label>
                        <select name="metodo_pago" id="metodo_pago" class="form-control mb-3">
                            <option value="">Selecciona una opción</option>
                            <option value="Efectivo">Efectivo</option>
                            <option value="Tarjeta">Tarjeta</option>
                        </select>
                        @error('metodo_pago')
                        <p>{{$message}}</p>
                        @enderror

                        <label class="fw-bold" for="entregado">Entregado</label>
                        <select id="entregado" class="form-control mb-3" disabled>
                            <option value="No" selected>No</option>
                        </select>
                        <input type="hidden" name="entregado" value="No">
                        @error('entregado')
                        <p>{{$message}}</p>
                        @enderror

                        <input type="hidden" name="fecha_pedido" id="fecha_pedido">

                        <div className="d-flex justify-content-center text-center mt-1">
                            <button type="submit" class="btn btn-success me-2">Realizar Pedido</button>
                            <a class="btn btn-warning me-1" href="{{route('inicio')}}">Cancelar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Personalización -->
<div class="modal fade" id="personalizarModal" tabindex="-1" aria-labelledby="personalizarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h5 class="modal-title" id="personalizarLabel">Personalizar Pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">

                <div class="mb-3">
                    <label class="fw-bold">Hamburguesa</label>
                    <select id="hamburguesa" class="form-select">
                        <option value="">Seleccionar</option>
                        <option value="Big Mac">Big Mac</option>
                        <option value="Cuarto de Libra">Cuarto de Libra</option>
                        <option value="McPollo">McPollo</option>
                    </select>
                </div>

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

                <div class="mb-3">
                    <label class="fw-bold">Extras / Quitar</label>
                    <input type="text" id="extras" class="form-control" placeholder="Ej: Sin cebolla, extra queso">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" onclick="generarDescripcion()">Agregar</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    // Establecer fecha y hora actual automáticamente
    document.addEventListener("DOMContentLoaded", function() {
        const ahora = new Date();
        const formato = ahora.toISOString().slice(0, 19).replace("T", " ");
        document.getElementById('fecha_pedido').value = formato;
    });

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

        // Cerrar modal
        var modal = bootstrap.Modal.getInstance(document.getElementById('personalizarModal'));
        modal.hide();
    }

    function ajustarOpcionesModal() {
        const tipo = document.getElementById('tipo').value.toLowerCase();
        const campos = ['hamburguesa', 'papas', 'refresco'];

        // Restaurar todos los selects
        campos.forEach(id => {
            document.getElementById(id).disabled = false;
            document.getElementById(id).value = "";
        });

        // Si es individual, solo permite uno
        if (tipo.includes('individual')) {
            campos.forEach(id => {
                document.getElementById(id).addEventListener('change', function() {
                    if (this.value !== "") {
                        campos.forEach(otherId => {
                            if (otherId !== id) {
                                document.getElementById(otherId).disabled = true;
                                document.getElementById(otherId).value = "";
                            }
                        });
                    } else {
                        campos.forEach(otherId => {
                            document.getElementById(otherId).disabled = false;
                        });
                    }
                });
            });
        }
    }
</script>
@endsection