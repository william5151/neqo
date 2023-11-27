<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    ///use HasFactory;
    protected $table = 'transacciones';
    protected $primaryKey = 'id_transaccion';

    protected $fillable = ['id_cuenta_origen', 'id_cuenta_destino', 'monto'];
    // Relación muchos a uno con la tabla Cuentas para obtener cuenta de origen
    public function cuentaOrigen()
    {
        return $this->belongsTo(Cuenta::class, 'id_cuenta_origen');
    }

    // Relación muchos a uno con la tabla Cuentas para obtener cuenta de destino
    public function cuentaDestino()
    {
        return $this->belongsTo(Cuenta::class, 'id_cuenta_destino');
    }
}