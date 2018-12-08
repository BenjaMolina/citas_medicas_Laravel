<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends User
{
    protected $fillable = [
        'cedula', 'especialidad','area_id','user_id'
    ];

    public function area(){
        return $this->belongsTo('App\Area');
    }

    public function usuario(){
        return $this->belongsTo('App\User');
    }

    public function horarios(){
        return $this->hasMany('App\Schedule');
    }

    public function citas(){
        return $this->hasMany('App\Appointment');
    }
    
    //Relacion polimorfica
    public function citable() {
        return $this->morphMany('App\Appointment','appointmentable');
    }
}
