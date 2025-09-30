<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Para login
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'correo',
        'contrasena',
        'rol',
    ];

    protected $hidden = [
        'contrasena',
        'remember_token',
    ];

    /**
     * ⚡ Indicar a Laravel que la contraseña es "contrasena"
     */
    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    /**
     * 🚫 Proteger al administrador para que no se pueda eliminar ni cambiar rol
     */
    protected static function booted()
    {
        // Evitar que se elimine el admin
        static::deleting(function ($usuario) {
            if ($usuario->rol === 'admin') {
                throw new \Exception("El administrador no puede ser eliminado.");
            }
        });

        // Evitar que se cambie el rol del admin
        static::updating(function ($usuario) {
            if ($usuario->rol === 'admin' && $usuario->isDirty('rol')) {
                throw new \Exception("No se puede cambiar el rol del administrador.");
            }
        });
    }

    /**
     * Relaciones
     */
    public function ticketsCreado()
    {
        return $this->hasMany(Ticket::class, 'id_cliente');
    }

    public function ticketsAsignado()
    {
        return $this->hasMany(Ticket::class, 'id_tecnico');
    }
}