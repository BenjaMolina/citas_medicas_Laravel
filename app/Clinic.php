<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $fillable = [
        'nombre','direccion','giro','telefono','correo','descripcion'
    ];

    public function users(){
        return $this->hasMany('App\User');
    }
}
