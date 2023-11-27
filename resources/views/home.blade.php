@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bienvenido!') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>¡Hola, {{ Auth::user()->name }}!</p>

                    <div class="mt-4">
                        <h4>Acciones Rápidas:</h4>
                        <div class="btn-group" role="group" aria-label="Acciones Rápidas">
                            <button id="btnTransacciones" class="btn btn-primary">
                                Transacciones Bancarias
                            </button>
                            <a href="{{ route('transacciones.listar') }}" class="btn btn-primary">
                                Listar Transferencias
                            </a>
                        </div>
                        
                        <!-- Opciones de Transacciones Bancarias (inicialmente ocultas) -->
                        <div id="opcionesTransacciones" style="display: none;">
                            <a href="{{ route('cuentas.propias') }}" class="btn btn-primary">
                                Transferencia entre Cuentas Propias
                            </a>

                            <a href="{{ route('cuentas.terceros') }}" class="btn btn-primary">
                                Transferencia a Cuentas de Terceros
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Incluir el archivo CSS -->
<link rel="stylesheet" href="{{ asset('assets/estiloshome.css') }}">

<!-- Incluir jQuery (puedes descargarlo o usar el enlace CDN) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Script para mostrar/ocultar opciones al hacer clic en el botón -->
<script>
    $(document).ready(function () {
        $("#btnTransacciones").click(function () {
            $("#opcionesTransacciones").toggle();
        });
    });
</script>


@endsection
