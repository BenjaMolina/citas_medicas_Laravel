<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'nombre','descripcion'
    ];

    public function doctors(){
        return $this->hasMany('App\Doctor');
    }
}
