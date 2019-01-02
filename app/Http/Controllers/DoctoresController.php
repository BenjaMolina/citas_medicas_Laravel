<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\User;
use App\Clinic;
use App\Area;

use Illuminate\Http\Request;

class DoctoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctores = Doctor::has('user')->with(['user','area'])->orderBy('id','DESC')->paginate();
        // $doctores = User::has('doctor')->with(['doctor','clinic'])->paginate();

        return view('doctors.index',compact('doctores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $clinicas = Clinic::all()->pluck('nombre','id');
        $clinicas = Clinic::all(['nombre','id']);
        $areas = Area::all(['nombre','id']);

        return view('doctors.create',compact('clinicas','areas'));
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
            'cedula' => 'required',
            'especialidad' => 'required',
            'user' => 'required|unique:users',
            'password' => 'required',
            'clinic_id' => 'required',
            'area_id' => 'required',
        ]);
        

        $user = User::create($request->all());

        // $user->doctor()->create([
        //     'cedula' => $request->cedula,
        //     'especialidad' => $request->especialidad,
        //     'area_id' => $request->area_id,
        // ]);

        $doctor = Doctor::create([
            'cedula' => $request->cedula,
            'especialidad' => $request->especialidad,
            'area_id' => $request->area_id,
            'user_id' => $user->id,
        ]);

        return redirect()->route('doctores.edit',$doctor->id)->with('success', 'Doctor agregado');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctore)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctore)
    {
        $clinicas = Clinic::all(['nombre','id']);
        $areas = Area::all(['nombre','id']);
        
        //Lazy Egear Loading
        $doctor = $doctore->load('user');

        return view('doctors.edit',compact('clinicas','areas','doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctore)
    {

        
        $this->validate($request,[
            'nombre' => 'required',
            'apellidos' => 'required',
            'correo' => 'required|email|unique:users,correo,'.$doctore->user->id,
            'telefono' => 'required',
            'cedula' => 'required',
            'especialidad' => 'required',
            'user' => 'required|unique:users,user,'.$doctore->user->id,
            // 'password' => 'required',
            'clinic_id' => 'required',
            'area_id' => 'required',
        ]);

        $user = $doctore->user()->find($doctore->user_id);
        $doctore->update($request->all());
        
        $user->fill($request->all());
        if($request->has('password')){
            $user->password = $request->password;
        }

        $user->save();

        return back()->with('success','Doctor editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctore)
    {
        $user = $doctore->user()->find($doctore->user_id);
        $doctore->delete();
        $user->delete();

        return back()->with('success','Doctor eliminado correctamente');
    }
}
