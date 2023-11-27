<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuenta;
use App\Models\Transaccion;

class TransferenciaController extends Controller
{
    public function cuentasPropias()
    {
        // Obtener las cuentas del usuario autenticado con las relaciones cargadas
        $cuentas = auth()->user()->cuentas()->with('usuario', 'tipoCuenta')->get();

        return view('transferencia.cuentasPropias', compact('cuentas'));
    }
// TransferenciaPropiasController.php


    public function realizarTransferencia(Request $request)
    {
        // Validaciones comunes a ambas transferencias
        $request->validate([
            'cuenta_origen' => 'required|exists:cuentas,id_cuenta',
            'monto' => 'required|numeric|min:0',
        ]);

        // Obtener las cuentas y verificar condiciones antes de la transferencia
        $cuentaOrigen = Cuenta::findOrFail($request->cuenta_origen);

        if ($cuentaOrigen->id_usuario !== auth()->id()) {
            return redirect()->back()->with('error', 'La cuenta de origen no pertenece al usuario.');
        }

        if ($request->monto <= 0) {
            return redirect()->back()->with('error', 'El monto de la transferencia debe ser mayor a cero.');
        }

        if ($cuentaOrigen->saldo < $request->monto) {
            return redirect()->back()->with('error', 'La cuenta de origen no tiene saldo suficiente.');
        }

        // Lógica específica para transferencia a cuentas propias
        if ($request->has('cuenta_destino') && !$request->has('cuenta_destino_tercero')) {
            $request->validate([
                'cuenta_destino' => 'required|different:cuenta_origen|exists:cuentas,id_cuenta',
            ]);

            $cuentaDestino = Cuenta::findOrFail($request->cuenta_destino);

            if ($cuentaOrigen->id_cuenta === $cuentaDestino->id_cuenta) {
                return redirect()->back()->with('error', 'La cuenta de origen y destino deben ser diferentes.');
            }

            // Crear la transacción
            $this->crearTransaccion($cuentaOrigen, $cuentaDestino, $request->monto);

            return redirect()->route('cuentas.propias')->with('status', 'Transferencia realizada con éxito');
        }
    }

    private function crearTransaccion($cuentaOrigen, $cuentaDestino, $monto)
    {
        // Crear la transacción
        $transaccion = new Transaccion([
            'id_cuenta_origen' => $cuentaOrigen->id_cuenta,
            'id_cuenta_destino' => $cuentaDestino->id_cuenta,
            'monto' => $monto,
        ]);

        $transaccion->save();

        // Actualizar saldos
        $cuentaOrigen->saldo -= $monto;
        $cuentaDestino->saldo += $monto;

        $cuentaOrigen->save();
        $cuentaDestino->save();
    }
}
