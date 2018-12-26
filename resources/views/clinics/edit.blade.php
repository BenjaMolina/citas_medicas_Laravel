@extends('app')

@section('content')
@include('partials.content_header',[
    'header' => 'Clinicas',
    "description" => 'Editar Clinica'
])

<section class="content container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Editar Clinica</h3>
                </div>
                <form action="{{ route('clinicas.update',$clinica->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    @include('clinics/form',[
                        'clinica'=>$clinica,
                    ])
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
