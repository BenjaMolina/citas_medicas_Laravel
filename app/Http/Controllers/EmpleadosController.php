<?php

namespace App\Http\Controllers;

use App\User;
use App\Clinic;
use App\Employee;
use Illuminate\Http\Request;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Employee::with(['user' => function($query){
            $query->select('id','nombre','apellidos','correo','telefono');
        }])
            ->orderBy('id','DESC')
            ->paginate();


        return view('employees.index',compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clinicas = Clinic::all();
        return view('employees.create',compact('clinicas'));
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
            'user' => 'required|unique:users',
            'password' => 'required',
            'clinic_id' => 'required',
        ]);

        $user = User::create($request->all());
        $empleado = $user->employee()->create([]);

        return redirect()
                    ->route('empleados.edit', $empleado->id)
                    ->with('success',"Empleado creado exitosamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $empleado)
    {
        

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $empleado)
    {
        $empleado->load('user');
        $clinicas = Clinic::all();
        return view('employees.edit',compact('clinicas','empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $empleado)
    {
        $this->validate($request,[
            'nombre' => 'required',
            'apellidos' => 'required',
            'correo' => 'required|email|unique:users,correo,'.$empleado->user->id,
            'telefono' => 'required',
            'user' => 'required|unique:users,user,'.$empleado->user->id,
            // 'password' => 'required',
            'clinic_id' => 'required',
        ]);

        try{
            $user = $empleado->user()->firstOrFail();
            $user->fill($request->all());

            if($request->has('password')){
                $user->password = $request->password;
            }

            $user->save();

            return back()->with('success','Empleado editado exitosamente');

        } catch(\Exception $e){
            return back()->with('danger','Error inesperado al editar');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $empleado)
    {
        try{
            $empleado->delete();
            $empleado->user()->firstOrFail()->delete();

            return back()->with('success', 'Empleado eliminado correctamente');

        } catch(\Exception $e){
            return back()->with('danger','Error inesperado al eliminar');
        }
    }
}
