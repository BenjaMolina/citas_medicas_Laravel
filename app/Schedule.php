<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    const ACTIVO = '1';
    const NO_ACTIVO = "0";

    protected $fillable = [
        'hora', 'estatus', 'doctor_id'
    ];

    public function esActivo(){
        return $this->estatus == Schedule::ACTIVO;
    }
    
    public function doctor(){
        return $this->belongsTo('App\Doctor');
    }


}
