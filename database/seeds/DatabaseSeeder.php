<?php

use App\Area;
use App\User;
use App\Clinic;
use App\Doctor;
use App\Patient;
use App\Employee;
use Illuminate\Database\Seeder;
use App\Appointment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $cantClinicas = 2;
        $cantAreas = 2;
        // $cantUsers = 300;
        $cantDoctors = 30;
        $cantEmpleados = 10;
        $cantPacientes = 150;
        $cantCitas = 50;

        factory(Clinic::class, $cantClinicas)->create();
        factory(Area::class, $cantAreas)->create();

        factory(User::class, $cantEmpleados)->create()->each(function ($user) {
            $empleado = factory(Employee::class)->create(['user_id' => $user->id]);
        });

        factory(User::class, $cantPacientes)->create()->each(function ($user) {
            $paciente = factory(Patient::class)->create(['user_id' => $user->id]);
        });
        
        factory(User::class, $cantDoctors)->create()->each(function ($user) {

            $doctor = factory(Doctor::class)->create(['user_id' => $user->id]);
            
           /*  Guardar con Relacion
            $doctor = new Doctor([
                'cedula' => '123123sda',
                'especialidad' =>'DAsdasdasdas',
                'area_id' => 1,
            ]);
            $user->doctor()->save($doctor); */
            
            /*     Guardar Relacion polimorfica
            $patient = Patient::all()->random();
            $empleado = Employee::all()->random(); 

            $doctor->citable()->create([
                'asunto' => 'asjdhjakshdjkhaksj',
                'hora' => '20:58:20',
                'fecha' => '1990-11-12',
                'estatus' => Appointment::ATENDIDO,
                'observaciones' => 'ajsdhjkashkjd',
                'patient_id' => $patient->id, 
                'doctor_id' => $doctor->id,
            ]); */
        });

        factory(Appointment::class,$cantCitas)->create();
        
        
    }
}
