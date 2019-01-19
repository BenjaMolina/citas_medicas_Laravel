@extends('app')

@section('content')
@include('partials.content_header',[
    'header' => 'Pacientes',
    "description" => 'Editar paciente'
])

{{ old('fecha_naci') }}

<section class="content container-fluid">
    <div class="row">
        <form action="{{ route('pacientes.update',$paciente->id) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="col-md-6">
                <div class="box box-primary">                      
                    @include('patients/forms/formDatos',[
                        'paciente'=>$paciente,                        
                        'clinicas' => $clinicas,               
                    ])
                </div>
            </div>
            {{-- <div class="col-md-4">
                <div class="box box-primary">                      
                    @include('patients/forms/formUser',[
                        'paciente'=>$paciente,                
                    ])
                </div>
            </div> --}}
            <div class="col-md-6">
                <div class="box box-primary">                      
                    @include('patients/forms/historial',[
                        'paciente'=>$paciente,                
                    ])
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
