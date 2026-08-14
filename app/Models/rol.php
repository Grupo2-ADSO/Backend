<?php

namespace App\Models;
   
use Illuminate\Database\Eloquent\Model;

class rol extends Model
{
    protected $table = 'rol';

    protected $primaryKey = 'IdRol';
    public $fillable = [
        'Nombre'
    ];

    public $timestamps = false;

}
