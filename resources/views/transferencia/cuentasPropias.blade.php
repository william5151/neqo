@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Transferencia entre Cuentas Propias') }}</div>

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

                        <!-- Verificar que $cuentas esté definido y no sea null -->
                        @if(isset($cuentas) && count($cuentas) > 0)
                            <!-- Formulario de Transferencia -->
                            <form method="POST" action="{{ route('transferencia.realizar') }}">
                                @csrf

                                <!-- Selección de cuenta origen -->
                                <label for="cuenta_origen">Selecciona la cuenta origen:</label>
                                <select name="cuenta_origen" id="cuenta_origen" required>
                                    @foreach($cuentas as $cuenta)
                                        <option value="{{ $cuenta->id_cuenta }}">
                                            {{ $cuenta->tipoCuenta->tipo_cuenta_nombre }} - Saldo: ${{ $cuenta->saldo }}
                                        </option>
                                    @endforeach
                                </select>

                                <!-- Selección de cuenta destino -->
                                <label for="cuenta_destino">Selecciona la cuenta destino:</label>
                                <select name="cuenta_destino" id="cuenta_destino" required>
                                    @foreach($cuentas as $cuenta)
                                        <option value="{{ $cuenta->id_cuenta }}">
                                            {{ $cuenta->tipoCuenta->tipo_cuenta_nombre }} - Saldo: ${{ $cuenta->saldo }}
                                        </option>
                                    @endforeach
                                </select>

                                <!-- Monto de la transferencia -->
                                <label for="monto">Monto de la transferencia:</label>
                                <input type="number" name="monto" id="monto" step="0.01" required>

                                <button type="submit">Transferir</button>
                            </form>
                        @else
                            <p>No hay cuentas disponibles para realizar la transferencia.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluir el archivo CSS -->
<link rel="stylesheet" href="{{ asset('assets/estilotranspro.css') }}">

@endsection

