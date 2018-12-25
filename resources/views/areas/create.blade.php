@extends('app')

@section('content')
@include('partials.content_header',[
    'header' => 'Areas',
    "description" => 'Nueva Área'
])

<section class="content container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Nueva Area</h3>
                </div>
                <form action="{{ route('areas.store') }}" method="post">
                    @csrf
                    @include('areas/form',[
                        'area'=>null,                    
                    ])
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
