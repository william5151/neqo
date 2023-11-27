<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCuenta extends Model
{
    /// use HasFactory;
    protected $table = 'tipos_cuentas';
    protected $primaryKey = 'id_tipo_cuenta';

    // Relación uno a muchos con la tabla Cuentas
    public function cuentas()
    {
        return $this->hasMany(Cuenta::class, 'id_tipo_cuenta');
    }
}
   

