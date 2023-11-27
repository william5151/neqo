<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Transaccion;
use App\Models\Cuenta;
use App\Models\TipoCuenta;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Insertar datos en la tabla tipos_cuentas
        TipoCuenta::create([
            'tipo_cuenta_nombre' => 'Cuenta Corriente',
        ]);

        // Insertar datos en la tabla users
        User::create([
            'name' => 'Nombre de Usuario',
            'numero_identificacion' => '1234',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
        ]);

        // Insertar datos en la tabla cuentas
        $cuentaOrigen = Cuenta::create([
            'id_usuario' => 1,
            'id_tipo_cuenta' => 1,
            'saldo' => 500.00,
        ]);

        $cuentaDestino = Cuenta::create([
            'id_usuario' => 1,
            'id_tipo_cuenta' => 1,
            'saldo' => 0.00,  // O cualquier otro saldo inicial que desees
        ]);

        // Insertar datos en la tabla transacciones
        Transaccion::create([
            'id_cuenta_origen' => $cuentaOrigen->id_cuenta,
            'id_cuenta_destino' => $cuentaDestino->id_cuenta,
            'monto' => 100.00,
        ]);
    }
}