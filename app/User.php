<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'apellidos', 'correo','telefono','user','activo','password','clinic_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Mutador
    public function setPasswordAttribute($password){
        $this->attributes['password'] = bcrypt($password);
    }



    public function clinic(){
        return $this->belongsTo('App\Clinic');
    }

    public function doctor(){
        return $this->hasOne('App\Doctor');
    }

    public function employee(){
        return $this->hasOne('App\Employee');
    }

    public function patient(){
        return $this->hasOne('App\Patient');
    }

}
