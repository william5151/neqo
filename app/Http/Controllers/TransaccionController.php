<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuenta;
use App\Models\Transaccion;

class TransaccionController extends Controller
{
    // TransaccionController.php
    public function listarTransacciones(Request $request)
    {
        // Obtener todos los parámetros de la solicitud
        $cuentaOrigen = $request->input('cuenta_origen');
        $cuentaDestino = $request->input('cuenta_destino');
    
        $transacciones = Transaccion::when($cuentaOrigen, function ($query) use ($cuentaOrigen) {
            return $query->where('id_cuenta_origen', $cuentaOrigen);
        })->when($cuentaDestino, function ($query) use ($cuentaDestino) {
            return $query->where('id_cuenta_destino', $cuentaDestino);
        })->simplePaginate(10);
    
        // Obtener listas de cuentas para los filtros
        $cuentasOrigen = Cuenta::pluck('id_cuenta', 'id_cuenta');
        $cuentasDestino = Cuenta::pluck('id_cuenta', 'id_cuenta');
    
        // Retornar la vista con las transacciones y las listas de cuentas
        return view('transacciones.transacciones', compact('transacciones', 'cuentasOrigen', 'cuentasDestino'));
    }
    
}
