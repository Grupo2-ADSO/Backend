<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    public $fillable = [
        'id_orden',
        'estado',
        'fecha',
        'observaciones',
        'usuario_IdUsuario'
    ];

    public $table = 'historial';

    public $primaryKey = 'idhistorial';

    public $timestamps = false;

}
