<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    protected $table = 'visita';

    public $timestamps = false;
    
    protected $fillable = [
        'nombrevisitante', 
        'apellidopaternovisitante', 
        'apellidomaternovisitante', 
        'numcel', 
        'id_motivo', 
        'fecha', 
        'estatus' 
    ];


}
