<?php

namespace App\Http\Controllers;

use App\Clinic;
use Illuminate\Http\Request;

class ClinicasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinicas = Clinic::paginate();

        return view('clinics/index', compact('clinicas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clinics/create');
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
            'direccion' => 'required',
            'giro' => 'required',
            'telefono' => 'required',
            'correo' => 'required|email|unique',
            'descripcion' => 'required',
        ]);

        $clinica = Clinic::create($request->all());

        return redirect()->route('clinicas.edit',$clinica->id)->with('success','Clinica agregada satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function show(Clinic $clinic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function edit(Clinic $clinica)
    {
        return view('clinics/edit',compact('clinica'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clinic  $clinica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clinic $clinica)
    {
        $this->validate($request,[
            'nombre' => 'required',
            'direccion' => 'required',
            'giro' => 'required',
            'telefono' => 'required',
            'correo' => 'required|email|unique:clinics,correo,'.$clinica->id,
            'descripcion' => 'required',
        ]);

        $clinica->update($request->all());

        return back()->with('success','Clinica Editada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clinic  $clinica
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clinic $clinica)
    {
        $clinica->delete();

        return redirect()->route('clinicas.index')->with('success','Clinica eliminada satisfactoriamente');
    }
}
