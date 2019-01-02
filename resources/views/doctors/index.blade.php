@extends('app')

@section('content')
@include('partials.content_header',[
    'header' => 'Docotores',
    "description" => 'Doctores Description'
])

<section class="content container-fluid">
        <a href="{{ route('doctores.create') }}" class="btn btn-flat btn-primary" title="Editar">
                <i class="fa fa-edit"></i> Nuevo Doctor
            </a>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Doctores Registrados</h3>

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
                            <th>Apellidos</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Especialidad</th>
                            <th>Acciones</th>
                        </tr>
                        @foreach ($doctores as $doctor)
                            <tr>
                                <td>{{ $doctor->id }}</td>
                                <td>{{ $doctor->user->nombre }}</td>
                                <td>{{ $doctor->user->apellidos }}</td>
                                <td>{{ $doctor->user->telefono }}</td>
                                <td>{{ $doctor->user->correo }}</td>
                                <td>{{ $doctor->especialidad }}</td>
                                <td>
                                    <div class="">
                                        <a href="{{ route('doctores.edit',$doctor->id) }}" class="btn btn-sm btn-primary" title="Editar">
                                            <i class="fa fa-edit"></i>Editar
                                        </a>
                                        <form action="{{ route('doctores.destroy',$doctor->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" title="Eliminar">
                                                <i class="fa fa-times"></i>Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        
                    </table>
                </div>
                <!-- /.box-body -->
                {{ $doctores->render() }}
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
@endsection
