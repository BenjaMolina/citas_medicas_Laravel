<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Appointment;
use Illuminate\Http\Request;
use App\Doctor;
use App\User;
use App\Patient;

class CitasController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request()->ajax()) {
            $citas = Appointment::with('patient.user')->get();

            return $citas;
        }

        $citas = Appointment::all();


        return view('citas.index', compact('citas'));
    }


    public function getcita(Request $request)
    {
        if ($request->ajax()) {
            $id = (int)$request->id;
            $cita = Appointment::whereId($id)->first();

            $doctores = $this->getDoctores();
            $pacientes = $this->getPacientes();

            return response()->json([
                'cita' => $cita,
                'doctores' => $doctores,
                'pacientes' => $pacientes,
            ]);
        }
    }


    public function showNewCitaModal(){
        $doctores = $this->getDoctores();
        $pacientes = $this->getPacientes();

        return response()->json([
            'doctores' => $doctores,
            'pacientes' => $pacientes,
        ]);
 
    }


    public function getDoctores(){
        return Doctor::with(['user' => function($q ){
            $q->select('id','nombre'); 
          }])->get();
    }

    public function getPacientes(){
        return Patient::with(['user' => function($q ){
            $q->select('id','nombre'); 
          }])->get();
    }
}
