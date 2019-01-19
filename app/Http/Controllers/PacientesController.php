<?php

namespace App\Http\Controllers;

use App\User;
use App\Clinic;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = Patient::with('user')->orderBy('id','DESC')->paginate();

        return view('patients.index',compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clinicas = Clinic::all();
        return view('patients.create',compact('clinicas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre' => 'required',
            'apellidos' => 'required',
            'correo' => 'required|email|unique:users',
            'telefono' => 'required',
            'clinic_id' => 'required',
            'tipo_sangre' => 'required',
            'peso' => 'required|integer',
            'talla' => 'required|integer',
            'estatura' => 'required|integer',
            'fecha_naci' => 'required',
            'sexo' => 'required|in:masculino,femenino',
        ]);

        try { 
            // throw new ModelNotFoundException("Error Processing Request", 1);
            
            $user = User::create($request->all());
            $paciente = $user->patient()->create([
                'tipo_sangre' => $request->tipo_sangre,
                'peso' => $request->peso,
                'talla' => $request->talla,
                'estatura' => $request->estatura,            
                'alergias' => $request->alergias,
                'medicamentos' => $request->medicamentos,
                'enfermedades' => $request->enfermedades,
                'fecha_naci' => $request->fecha_naci,
                'sexo' => $request->sexo,
            ]);

            return redirect()->route('pacientes.edit',$paciente->id)->with('success','Paciente agregado con exito');
        }
        catch(\Exception $e){
            return back()
                    ->withInput()
                    ->with("danger","Error inesperado al guardar");
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $paciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $paciente
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $paciente)
    {
        $paciente->load('user');
        $clinicas = Clinic::all();

        return view('patients.edit',compact('paciente','clinicas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $paciente)
    {
        $this->validate($request,[
            'nombre' => 'required',
            'apellidos' => 'required',
            'correo' => 'required|email|unique:users,correo,'.$paciente->user->id,
            'telefono' => 'required',
            'clinic_id' => 'required',
            'tipo_sangre' => 'required',
            'peso' => 'required|integer',
            'talla' => 'required|integer',
            'estatura' => 'required|integer',
            'fecha_naci' => 'required',
            'sexo' => 'required|in:masculino,femenino',
        ]);

        try{
            $user = $paciente->user()->firstOrFail()->update($request->all());
            $paciente->update($request->all());

            return back()->with('success',"Registro actualizado con exito");
        }
        catch(\Exception $e){
            return back()
                    ->withInput()
                    ->with("danger","Error inesperado al guardar");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $paciente)
    {
        try{
            $paciente->delete();
            $paciente->user()->firstOrFail()->delete();
            
            return back()->with('success','Paciente eliminado satisfactoriamente');
        }
        catch(\Exception $e){
            return back()->with('danger', "Error inesperado al Eliminar");
        }
    }
}
