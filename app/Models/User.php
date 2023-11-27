<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'numero_identificacion',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function cuentas()
    {
        return $this->hasMany(Cuenta::class, 'id_usuario', 'id');
    }
    public function cuentasDeTerceros()
    {
        // Obtén las cuentas propias del usuario
        $cuentasPropiasIds = $this->cuentas()->pluck('id_cuenta');
    
        // Devuelve las cuentas que no pertenecen al usuario (cuentas de terceros)
        return Cuenta::whereNotIn('id_cuenta', $cuentasPropiasIds)->get();
    }
}
