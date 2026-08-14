<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    public $fillable = [
        "nombre"
    ];

    public $table = 'ambientes';

    public $primaryKey = 'id_ambiente';

    public $timestamps = false;
}
