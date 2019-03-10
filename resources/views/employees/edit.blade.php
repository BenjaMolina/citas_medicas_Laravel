@extends('app')

@section('content')
@include('partials.content_header',[
    'header' => 'Empleados',
    "description" => 'Editar Empleado'
])

<section class="content container-fluid">
    <div class="row">
        <form action="{{ route('empleados.update',$empleado->id) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="col-md-8">
                <div class="box box-primary">                      
                    @include('employees/forms/formDatos',[
                        'empleado'=>$empleado,                        
                        'clinicas' => $clinicas,                    
                    ])
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">                      
                    @include('employees/forms/formUser',[
                        'empleado'=>$empleado,                
                    ])
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
