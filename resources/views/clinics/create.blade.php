@extends('app')

@section('content')
@include('partials.content_header',[
    'header' => 'Clinicas',
    "description" => 'Nueva Clinica'
])

<section class="content container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Nueva Clinica</h3>
                </div>
                <form action="{{ route('clinicas.store') }}" method="post">
                    @csrf
                    @include('clinics/form',[
                        'clinica'=>null,                    
                    ])
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
