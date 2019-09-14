<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Appointment;
use App\Doctor;
use App\User;
use App\Patient;
use Validator;
use App\Employee;

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
            $dateStart = request()->start;
            $dateEnd = request()->end;
            $citas = Appointment::with([
                'patient' => function ($q) {
                    $q->select(['id', 'fecha_naci', 'user_id']);
                },
                'patient.user' => function ($q) {
                    $q->select(['id', 'nombre']);
                }
            ])
                ->where('fecha', '>=', $dateStart)
                ->where('fecha', '<=', $dateEnd)
                ->get(['id', 'doctor_id', 'patient_id', 'fecha', 'hora', 'observaciones', 'estatus', 'appointmentable_id', 'appointmentable_type', 'asunto', 'created_at', 'updated_at']);

            return $citas;
        }

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

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator = $this->validatorStoreAndUpdate($request);
            if ($validator->fails()) {
                return response()->json(["errors" => $validator->errors()->getMessages(), "success" => false], 422);
            }
            // $cita = Appointment::create($request->all());
            $empleado = Employee::find(1);
            $cita = $empleado->citable()->create($request->all());
            return response()->json(['cita' => $cita], 201);
        }
    }

    public function update(Request $request, Appointment $cita)
    {
        if ($request->ajax()) {
            $validator = $this->validatorStoreAndUpdate($request);
            if ($validator->fails()) {
                return response()->json(["errors" => $validator->errors()->getMessages(), "success" => false], 422);
            }

            $cita->update($request->all());
            return response()->json(['cita' => $cita], 200);
        }
    }

    public function destroy(Request $request, Appointment $cita)
    {
        if ($request->ajax()) {
            $cita->delete();

            return response()->json(['cita' => $cita], 200);
        }
    }



    public function showNewCitaModal()
    {
        $doctores = $this->getDoctores();
        $pacientes = $this->getPacientes();

        return response()->json([
            'doctores' => $doctores,
            'pacientes' => $pacientes,
        ]);
    }


    public function getDoctores()
    {
        return Doctor::with(['user' => function ($q) {
            $q->select('id', 'nombre');
        }])->get();
    }

    public function getPacientes()
    {
        return Patient::with(['user' => function ($q) {
            $q->select('id', 'nombre');
        }])->get();
    }

    private function validatorStoreAndUpdate(Request $request)
    {
        return Validator::make(
            $request->all(),
            [
                'patient_id' => 'required|integer|exists:patients,id',
                'doctor_id' => [
                    'required',
                    'integer',
                    Rule::exists('doctors', 'id'),
                ],
                'fecha' => 'required|date_format:"Y-m-d"',
                'hora' => 'required|date_format:"H:i"',
                // 'asunto' =>'',
                // 'observaciones' =>,
            ]
        );
    }
}
