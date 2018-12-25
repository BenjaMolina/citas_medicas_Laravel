@extends('app')

@section('content')
@include('partials.content_header',[
    'header' => 'Areas',
    "description" => 'Areas Description'
])

<section class="content container-fluid">
        <a href="{{ route('areas.create') }}" class="btn btn-flat btn-primary" title="Editar">
                <i class="fa fa-edit"></i> Nueva Área
            </a>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Areas Registradas</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>Registro</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Acciones</th>
                        </tr>
                        @foreach ($areas as $area)
                            <tr>
                                <td>{{ $area->id }}</td>
                                <td>{{ $area->nombre }}</td>
                                <td>{{ $area->descripcion }}</td>
                                <td>
                                    <a href="{{ route('areas.edit',$area->id) }}" class="btn btn-sm btn-primary" title="Editar">
                                        <i class="fa fa-edit"></i>Editar
                                    </a>
                                    <form action="{{ route('areas.destroy',$area->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" title="Eliminar">
                                            <i class="fa fa-times"></i>Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
@endsection
