@extends('app')

@section('content')
@include('partials.content_header',[
    'header' => 'Empleado',
    "description" => 'Nuevo Empleado'
])

<section class="content container-fluid">
    <div class="row">
        <form action="{{ route("empleados.store") }}" method="POST">
            @csrf
            <div class="col-md-8">
                <div class="box box-primary">                      
                    @include('employees/forms/formDatos',[
                        'empleado'=>null,               
                        'clinicas' => $clinicas,                    
                    ])
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">                      
                    @include('employees/forms/formUser',[
                        'empleado'=>null,                
                    ])
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
