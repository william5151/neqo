<?php

// TransferenciaTercerosController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuenta;
use App\Models\Transaccion;

class TransferenciaTercerosController extends Controller
{

    public function cuentasTerceros()
    {
        // Lógica para obtener y mostrar las cuentas de terceros del usuario
        $cuentasTerceros = auth()->user()->cuentasDeTerceros();
        // Obtén también las cuentas propias para mostrarlas en la vista
        $cuentasPropias = auth()->user()->cuentas()->with('usuario', 'tipoCuenta')->get();

        return view('transferencia.cuentasTerceros', compact('cuentasTerceros','cuentasPropias'));
    }
    
    public function realizarTransferencia(Request $request)
    {
        // Validaciones específicas para transferencia a cuentas de terceros
        $request->validate([
            'cuenta_origen' => 'required|exists:cuentas,id_cuenta',
            'monto' => 'required|numeric|min:0',
            'cuenta_destino_tercero' => 'required|exists:cuentas,id_cuenta',
        ]);

        // Obtener las cuentas y verificar condiciones antes de la transferencia
        $cuentaOrigen = Cuenta::findOrFail($request->cuenta_origen);
        $cuentaDestinoTercero = Cuenta::findOrFail($request->cuenta_destino_tercero);

        if ($cuentaOrigen->id_usuario !== auth()->id()) {
            return redirect()->back()->with('error', 'La cuenta de origen no pertenece al usuario.');
        }

        if ($request->monto <= 0) {
            return redirect()->back()->with('error', 'El monto de la transferencia debe ser mayor a cero.');
        }

        if ($cuentaOrigen->saldo < $request->monto) {
            return redirect()->back()->with('error', 'La cuenta de origen no tiene saldo suficiente.');
        }

        if (!$cuentaDestinoTercero->matriculadaParaTransferencias()) {
            return redirect()->back()->with('error', 'La cuenta de destino no está matriculada para transferencias.');
        }

        // Realizar la transferencia
        $this->crearTransaccion($cuentaOrigen, $cuentaDestinoTercero, $request->monto);

        return redirect()->route('cuentas.terceros')->with('status', 'Transferencia a cuentas de terceros realizada con éxito');
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