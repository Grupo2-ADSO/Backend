<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class habitaciones extends Model
{
    public $fillable = [
        'No_habitacion',
        'piso',
        'tipo_hab'
    ];

    public $table = 'habitaciones';

    public $incrementing = false;

    public $keyType = 'int';

    public $primaryKey = 'No_habitacion';

    public $timestamps = false;
}
