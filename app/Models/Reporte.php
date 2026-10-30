<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\habitaciones;
use App\Models\Ambiente;
use App\Models\usuario;

class reporte extends Model
{
    public $table = 'reportes';

    protected $primaryKey = 'IdReporte';

    public $timestamps = false;

    protected $fillable = [
        'Tipo',
        'fecha_registro',
        'usuario_IdUsuario',
        'habitaciones_No_habitacion',
        'ambientes_id_ambiente',
    ];
    public function usuario()
    {
        return $this->belongsTo(usuario::class,'usuario_IdUsuario','IdUsuario');
    }
    public function habitaciones()
    {
        return $this->belongsTo(habitaciones::class,'habitaciones_No_habitacion','No_habitacion');
    }
    public function ambiente()
    {
        return $this->belongsTo( Ambiente::class,'ambientes_id_ambiente','id_ambiente');
    }
}
