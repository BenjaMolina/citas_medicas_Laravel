@extends('app')

@section('content')
@include('partials.content_header',[
    'header' => 'Doctores',
    "description" => 'Editar Doctor'
])

<section class="content container-fluid">
    <div class="row">
        <form action="{{ route('doctores.update',$doctor->id) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="col-md-8">
                <div class="box box-primary">                      
                    @include('doctors/formDatos',[
                        'doctor'=>$doctor,                        
                        'clinicas' => $clinicas,    
                        'areas' => $areas,                    
                    ])
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">                      
                    @include('doctors/formUser',[
                        'doctor'=>$doctor,                
                    ])
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
