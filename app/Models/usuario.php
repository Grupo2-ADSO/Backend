<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class usuario extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'usuarios';

    protected $primaryKey = 'IdUsuario';

    public $timestamps = false;

    protected $fillable = [
        'Nombre',
        'Apellidos',
        'Correo',
        'Contrasena',
        'Estado',
        'Cedula',
        'Telefono',
        'Rol_IdRol'
    ];

    protected $hidden = [
        'Contrasena',
    ];

    public function getAuthPassword()
    {
        return $this->Contrasena;
    }

    public function rol()
    {
        return $this->belongsTo(
            rol::class,
            'Rol_IdRol',
            'IdRol'
        );
    }
}