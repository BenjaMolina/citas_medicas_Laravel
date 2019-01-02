@extends('app')

@section('content')
@include('partials.content_header',[
    'header' => 'Doctores',
    "description" => 'Nuevo Doctor'
])

<section class="content container-fluid">
    <div class="row">
        <form action="{{ route("doctores.store") }}" method="POST">
            @csrf
            <div class="col-md-8">
                <div class="box box-primary">                      
                    @include('doctors/formDatos',[
                        'doctor'=>null,                        
                        'clinicas' => $clinicas,    
                        'areas' => $areas,                    
                    ])
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">                      
                    @include('doctors/formUser',[
                        'doctor'=>null,                
                    ])
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
