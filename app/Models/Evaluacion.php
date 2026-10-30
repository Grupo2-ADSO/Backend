<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    public $table = 'evaluacion';

    protected $primaryKey = 'idEvaluacion';

    public $timestamps = false;

    protected $fillable = [
        'comentario',
        'calificacion',
        'fecha_evaluacion',
    ];
}
