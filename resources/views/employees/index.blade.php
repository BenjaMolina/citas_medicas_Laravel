@extends('app')

@section('content')
@include('partials.content_header',[
    'header' => 'Empleados',
    "description" => 'Empleados Registrados'
])

<section class="content container-fluid">
        <a href="{{ route('empleados.create') }}" class="btn btn-flat btn-primary" title="Editar">
                <i class="fa fa-edit"></i> Nuevo Empleado
            </a>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Empleados Registrados</h3>

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
                            <th colspan="2" class="text-center">Acciones</th>
                        </tr>
                        @foreach ($empleados as $empleado)
                            <tr>
                                <td>{{ $empleado->id }}</td>
                                <td>{{ $empleado->user->nombre }}</td>
                                <td>{{ $empleado->user->apellidos }}</td>
                                <td>{{ $empleado->user->telefono }}</td>
                                <td>{{ $empleado->user->correo }}</td>
                                <td>
                                    <a href="{{ route('empleados.edit',$empleado->id) }}" class="btn btn-sm btn-primary" title="Editar">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('empleados.destroy',$empleado->id) }}" method="post">
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
                {{ $empleados->render() }}
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
@endsection
