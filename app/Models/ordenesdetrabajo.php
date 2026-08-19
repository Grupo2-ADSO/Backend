<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ordenesdetrabajo extends Model
{
    public $table = 'ordenes_de_trabajos';

    protected $primaryKey = 'idOrden';

    public $timestamps = false;

    protected $fillable = [
        'descripcion',
        'prioridad',
        'fecha_creacion',
        'reportes_IdReporte',
        'ambientes_id_ambiente',
        'habitaciones_No_habitacion',
        'usuario_IdUsuario',
    ];

    public function reporte()
    {
        return $this->belongsTo(reporte::class,'reportes_IdReporte','IdReporte');
    }

    public function ambiente()
    {
        return $this->belongsTo(ambiente::class,'ambientes_id_ambiente','id_ambiente');
    }

    public function habitacion()
    {
        return $this->belongsTo(habitacion::class,'habitaciones_No_habitacion','No_habitacion');
    }

    public function usuario()
    {
        return $this->belongsTo(usuario::class,'usuario_IdUsuario','IdUsuario');
    }
}
