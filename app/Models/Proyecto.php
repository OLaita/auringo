<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'desCorta',
        'meta',
        'financiacionActual',
        'section',
        'idCategoria',
        'iban',
        'iduser',
        'fechaInicio',
        'fechaFin',
        'fotoProyecto'
    ];
}
