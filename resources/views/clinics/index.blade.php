@extends('app')

@section('content')
@include('partials.content_header',[
    'header' => 'Clinicas',
    "description" => 'Clinicas Description'
])

<section class="content container-fluid">
        <a href="{{ route('clinicas.create') }}" class="btn btn-flat btn-primary" title="Editar">
                <i class="fa fa-edit"></i> Nueva Clinica
            </a>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Clinicas Registradas</h3>

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
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Descripcion</th>
                            <th>Acciones</th>
                        </tr>
                        @foreach ($clinicas as $clinica)
                            <tr>
                                <td>{{ $clinica->id }}</td>
                                <td>{{ $clinica->nombre }}</td>
                                <td>{{ $clinica->direccion }}</td>
                                <td>{{ $clinica->telefono }}</td>
                                <td>{{ $clinica->correo }}</td>
                                <td>{{ $clinica->descripcion }}</td>
                                <td>
                                    <div class="">
                                        <a href="{{ route('clinicas.edit',$clinica->id) }}" class="btn btn-sm btn-primary" title="Editar">
                                            <i class="fa fa-edit"></i>Editar
                                        </a>
                                        <form action="{{ route('clinicas.destroy',$clinica->id) }}" method="post">
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
                {{ $clinicas->render() }}
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
@endsection
