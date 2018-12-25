 <!-- general form elements -->
 
  <!-- /.box-header -->
  <!-- form start -->
  <div class="box-body">
    <div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
        <label for="nombre">Nombre </label>
        <input type="text" value="{{ $area ? $area->nombre : old('nombre') }}" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
        {!! $errors->first('nombre', '<span class="help-block">:message</span>')  !!}
    </div>
    <div class="form-group {{ $errors->has('descripcion') ? 'has-error' : '' }}">
        <label for="descripcion">Descripcion</label>
        <input type="text" value="{{ $area ? $area->descripcion : old('descripcion') }}" name="descripcion" class="form-control" id="descripcion" placeholder="Descripcion">
        {!! $errors->first('descripcion', '<span class="help-block">:message</span>')  !!}
    </div>
</div>
<!-- /.box-body -->

<div class="box-footer">
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ route('areas.index') }}" class="btn btn-danger">Cancelar</a>
</div>

<!-- /.box -->