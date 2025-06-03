<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Personal extends Authenticatable implements JWTSubject
{
    protected $table = 'personal';
    protected $primaryKey = 'id_personal';

    protected $fillable = [
        'nombre',
        'apellidopaterno',
        'apellidomaterno',
        'id_departamento',
        'contrasena',
        'num_puesto',
        'numcel',
        'cancelado',
        'email'
    ];

    protected $hidden = ['contrasena'];



    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getAuthPassword()
    {
        return $this->contrasena;
    }
}
