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
                    <h3 class="box-title">Editar Area</h3>
                </div>
                <form action="{{ route('areas.update',$area->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    @include('areas/form',[
                        'area'=>$area,
                    ])
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
