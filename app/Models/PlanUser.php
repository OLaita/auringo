<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanUser extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable =([
        'idUsuario',
        'idPlan',
        'idProyecto'
    ]);
}
