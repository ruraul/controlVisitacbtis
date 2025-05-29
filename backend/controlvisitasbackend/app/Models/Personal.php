<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $table = 'personal';

    protected $fillable = [
        'nombre',
        'apellidopaterno',
        'apellidomaterno',
        'id_departamento',
        'contrasena',
        'num_puesto',
        'numcel'
    ];

    public function setContrasenaAttribute($value){
        $this->attributes['contrasena'] = bcrypt($value);
    }
}
