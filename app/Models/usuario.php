<?php
  
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    public $table = 'usuario';

    protected $primaryKey = 'IdUsuario';

    public $fillable = [
        'Nombre',
        'Apellidos',
        'Correo',
        'Contrasena',
        'Estado',
        'Cedula',
        'Telefono',
        'Rol_IdRol'
    ];

    public $timestamps = false;

     protected $hidden = [ 'Contrasena'];

    public function rol()
    {
        return $this->belongsTo(rol::class, 'Rol_IdRol', 'IdRol');
    }
}
          