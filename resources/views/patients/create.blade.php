@extends('app')

@section('content')
@include('partials.content_header',[
    'header' => 'Pacientes',
    "description" => 'Nuevo Paciente'
])

<section class="content container-fluid">
    <div class="row">
        <form action="{{ route("pacientes.store") }}" method="POST">
            @csrf
            <div class="col-md-6">
                <div class="box box-primary">                      
                    @include('patients/forms/formDatos',[
                        'paciente'=>null,                        
                        'clinicas' => $clinicas,               
                    ])
                </div>
            </div>
            {{-- <div class="col-md-4">
                <div class="box box-primary">                      
                    @include('patients/forms/formUser',[
                        'paciente'=>null,                
                    ])
                </div>
            </div> --}}
            <div class="col-md-6">
                <div class="box box-primary">                      
                    @include('patients/forms/historial',[
                        'paciente'=>null,                
                    ])
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
