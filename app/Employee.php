<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends User
{
    protected $fillable= [
        'user_id'
    ];

    public function usuario(){
        return $this->belongsTo('App\User');
    }

    //Relacion polimorfica
    public function citable(){
        return $this->morphMany('App\Appointment','appointmentable');
    }
}
