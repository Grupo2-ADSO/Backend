<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class historial extends Model
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