<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    const ATENDIDO = 'atendido';
    const NO_ATENDIDO = 'no atendido';

    protected $fillable = [
        'asunto', 'hora','fecha', 'estatus', 'observaciones', 'patient_id', 'doctor_id', 'appointmentable_id', 'appointmentable_type'
    ];

    public function citable(){
        return $this->morphTo();
    }

    public function esAtendido(){
        return $this->estatus == Appointment::ATENDIDO;
    }
}
