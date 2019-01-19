<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends User
{
    protected $fillable = [
        'tipo_sangre','peso','talla','estatura','alergias','medicamentos','enfermedades','fecha_naci','sexo','user_id'
    ];


    public function citas(){
        return $this->hasMany('App\Appointment');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    //Relacion polimorfica
    public function citable(){
        return $this->morphMany('App\Appointment','appointmentable');
    }
}
