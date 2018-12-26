 <!-- general form elements -->
 
  <!-- /.box-header -->
  <!-- form start -->
  <div class="box-body">
    <div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
        <label for="nombre">Nombre </label>
        <input type="text" value="{{ $clinica ? $clinica->nombre : old('nombre') }}" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
        {!! $errors->first('nombre', '<span class="help-block">:message</span>')  !!}
    </div>
    <div class="form-group {{ $errors->has('direccion') ? 'has-error' : '' }}">
        <label for="direccion">Direccion </label>
        <input type="text" value="{{ $clinica ? $clinica->direccion : old('direccion') }}" class="form-control" name="direccion" id="direccion" placeholder="Direccion">
        {!! $errors->first('direccion', '<span class="help-block">:message</span>')  !!}
    </div>
    <div class="form-group {{ $errors->has('giro') ? 'has-error' : '' }}">
        <label for="giro">Giro </label>
        <input type="text" value="{{ $clinica ? $clinica->giro : old('giro') }}" class="form-control" name="giro" id="giro" placeholder="Giro">
        {!! $errors->first('giro', '<span class="help-block">:message</span>')  !!}
    </div>
    <div class="form-group {{ $errors->has('telefono') ? 'has-error' : '' }}">
        <label for="telefono">telefono </label>
        <input type="phone" value="{{ $clinica ? $clinica->telefono : old('telefono') }}" class="form-control" name="telefono" id="telefono" placeholder="Telefono">
        {!! $errors->first('telefono', '<span class="help-block">:message</span>')  !!}
    </div>
    <div class="form-group {{ $errors->has('correo') ? 'has-error' : '' }}">
        <label for="correo">correo </label>
        <input type="email" value="{{ $clinica ? $clinica->correo : old('correo') }}" class="form-control" name="correo" id="correo" placeholder="Correo">
        {!! $errors->first('correo', '<span class="help-block">:message</span>')  !!}
    </div>
    <div class="form-group {{ $errors->has('descripcion') ? 'has-error' : '' }}">
        <label for="descripcion">Descripcion</label>
        <input type="text" value="{{ $clinica ? $clinica->descripcion : old('descripcion') }}" name="descripcion" class="form-control" id="descripcion" placeholder="Descripcion">
        {!! $errors->first('descripcion', '<span class="help-block">:message</span>')  !!}
    </div>
</div>
<!-- /.box-body -->

<div class="box-footer">
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ route('clinicas.index') }}" class="btn btn-danger">Cancelar</a>
</div>

<!-- /.box -->