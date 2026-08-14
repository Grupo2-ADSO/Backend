<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evidencia extends Model
{
    public $fillable = [
        "tipo",
        "fecha_envio",
        "ruta_archivo",
        "observaciones",
        "ordenes_de_trabajo_idOrden",
        "evalucion_idEvalucion"
    ];

    public $table = "evidencia";

    public $primaryKey = 'idEvidencia';

    public $timestamps = false;

}
