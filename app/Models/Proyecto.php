<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

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


    public function cate(){
        return $this->belongsTo('App\Models\Categoria','idCategoria','id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User','iduser','id');
    }
}
