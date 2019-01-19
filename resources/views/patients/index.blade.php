@extends('app')

@section('content')
@include('partials.content_header',[
    'header' => 'Pacientes',
    "description" => 'Pacientes Registrados'
])

<section class="content container-fluid">
        <a href="{{ route('pacientes.create') }}" class="btn btn-flat btn-primary" title="Editar">
                <i class="fa fa-edit"></i> Nuevo Paciente
            </a>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Pacientes Registrados</h3>

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
                            <th>Sexo</th>
                            <th colspan="2" class="text-center">Acciones</th>
                        </tr>
                        @foreach ($pacientes as $paciente)
                            <tr>
                                <td>{{ $paciente->id }}</td>
                                <td>{{ $paciente->user->nombre }}</td>
                                <td>{{ $paciente->user->apellidos }}</td>
                                <td>{{ $paciente->user->telefono }}</td>
                                <td>{{ $paciente->user->correo }}</td>
                                <td>{{ $paciente->sexo }}</td>
                                <td>
                                    <a href="{{ route('pacientes.edit',$paciente->id) }}" class="btn btn-sm btn-primary" title="Editar">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('pacientes.destroy',$paciente->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" title="Eliminar">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        
                    </table>
                </div>
                <!-- /.box-body -->
                {{ $pacientes->render() }}
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
@endsection
