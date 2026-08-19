<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    public $table = 'ambientes';
    public $primaryKey = 'id_ambiente';
    public $timestamps = false;

     public $fillable = [
        "nombre"
    ];
}
