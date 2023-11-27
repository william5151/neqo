@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Listado de Transacciones') }}</div>

                    <div class="card-body">
                        <!-- Opciones de filtrado -->
                        <form method="get" action="{{ route('transacciones.listar') }}">
                            <!-- Filtrado por cuenta origen -->
                            <div class="form-group">
                                <label for="cuenta_origen">Cuenta de Origen:</label>
                                <select name="cuenta_origen" id="cuenta_origen" class="form-control">
                                    <option value="">Todas las cuentas</option>
                                    @foreach ($cuentasOrigen as $cuenta)
                                        <option value="{{ $cuenta }}">{{ $cuenta }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Filtrado por cuenta destino -->
                            <div class="form-group">
                                <label for="cuenta_destino">Cuenta de Destino:</label>
                                <select name="cuenta_destino" id="cuenta_destino" class="form-control">
                                    <option value="">Todas las cuentas</option>
                                    @foreach ($cuentasDestino as $cuenta)
                                        <option value="{{ $cuenta }}">{{ $cuenta }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" >Filtrar</button>
                        </form>

                        <!-- Lista de transacciones -->
                        @if ($transacciones->isEmpty())
                            <p>No hay datos de transferencias para mostrar.</p>
                        @else
                            <ul>
                                @foreach ($transacciones as $transaccion)
                                    <li>
                                        Fecha y Hora: {{ $transaccion->created_at }} |
                                        Cuenta Origen: {{ $transaccion->id_cuenta_origen }} |
                                        Cuenta Destino: {{ $transaccion->id_cuenta_destino }} |
                                        Monto: {{ $transaccion->monto }}
                                    </li>
                                @endforeach
                            </ul>

                            <!-- Paginación -->
                            {{ $transacciones->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="{{ asset('assets/estilolista.css') }}">
@endsection
