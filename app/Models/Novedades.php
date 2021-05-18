<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Novedades extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'idProyecto',
        'titulo',
        'descripcion',
        'fechaActualizacion'
    ];
}
