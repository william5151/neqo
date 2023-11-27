<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    ///use HasFactory;
    protected $table = 'cuentas';
    protected $primaryKey = 'id_cuenta';

    // Relación muchos a uno con la tabla Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    // Relación muchos a uno con la tabla TipoCuenta
    public function tipoCuenta()
    {
        return $this->belongsTo(TipoCuenta::class, 'id_tipo_cuenta');
    }

    // Relación uno a muchos con la tabla Transacciones para obtener transacciones de esta cuenta
    public function transaccionesOrigen()
    {
        return $this->hasMany(Transaccion::class, 'id_cuenta_origen');
    }

    public function transaccionesDestino()
    {
        return $this->hasMany(Transaccion::class, 'id_cuenta_destino');
    }

    
    public function matriculadaParaTransferencias()
    {
    return $this->matriculada_para_transferencias;
    }

}
