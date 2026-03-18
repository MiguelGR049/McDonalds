@extends('plantilla')

@section('contenido')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4">

                <h3 class="text-center mb-4">Recuperar PIN</h3>

                @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
                @endif

                <form method="POST" action="{{route('recuperar_pin')}}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" required>
                        @error('email')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            Generar Nuevo PIN
                        </button>
                    </div>

                </form>

                <div class="text-center mt-3">
                    <a href="{{route('login')}}">Volver al Login</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection