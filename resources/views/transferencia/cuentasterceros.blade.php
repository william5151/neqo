@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Transferencia a Cuentas de Terceros') }}</div>

                    <div class="card-body">
                        <!-- Mostrar mensajes de éxito o error -->
                        @if(session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif 

                        <!-- Verificar que $cuentasPropias esté definido y no sea null -->
                        @if(isset($cuentasPropias) && count($cuentasPropias) > 0)
                            <!-- Formulario de Transferencia -->
                            <form method="POST" action="{{ route('transferencia.terceros.realizar') }}">
                                @csrf

                                <!-- Selección de cuenta de origen -->
                                <div class="form-group">
                                    <label for="cuenta_origen">Cuenta de Origen:</label>
                                    <select name="cuenta_origen" id="cuenta_origen" class="form-control" required>
                                        @foreach($cuentasPropias as $cuenta)
                                            <option value="{{ $cuenta->id_cuenta }}">
                                                {{ $cuenta->id_cuenta }} - Saldo: ${{ $cuenta->saldo }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Selección de cuenta de destino -->
                                <div class="form-group">
                                    <label for="cuenta_destino_tercero">Cuenta de Destino:</label>
                                    <select name="cuenta_destino_tercero" id="cuenta_destino_tercero" class="form-control" required>
                                        @foreach($cuentasTerceros as $cuentaTercero)
                                            <option value="{{ $cuentaTercero->id_cuenta }}">
                                                {{ $cuentaTercero->id_cuenta }} - Saldo: ${{ $cuentaTercero->saldo }}
                                                (Propietario: {{ $cuentaTercero->usuario->name }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Monto de la transferencia -->
                                <div class="form-group">
                                    <label for="monto">Monto de la Transferencia:</label>
                                    <input type="number" name="monto" id="monto" class="form-control" min="0" step="0.01" required>
                                </div>

                                <button type="submit">Transferir</button>
                            </form>
                        @else
                            <p>No hay cuentas propias disponibles. No se pueden realizar transferencias.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluir el archivo CSS -->
    <link rel="stylesheet" href="{{ asset('assets/estilotranspro.css') }}">
@endsection
