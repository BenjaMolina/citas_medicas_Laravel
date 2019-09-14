<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends User
{
    protected $fillable = [
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //Relacion polimorfica
    public function citable()
    {
        return $this->morphMany(Appointment::class, 'appointmentable');
    }
}
