 <!-- general form elements -->
 
  <!-- /.box-header -->
  <!-- form start -->
  <div class="box-body">
    <div class="form-group {{ $errors->has('correo') ? 'has-error' : '' }}">
        <label for="correo">Correo </label>
        <input type="email" value="{{ ($doctor && old('correo') == null) ? $doctor->user->correo : old('correo') }}" class="form-control" name="correo" id="correo" placeholder="Correo">
        {!! $errors->first('correo', '<span class="help-block">:message</span>')  !!}
    </div>
    
    <div class="form-group {{ $errors->has('user') ? 'has-error' : '' }}">
        <label for="user">Usuario </label>
        <input type="text" value="{{ ($doctor && old('user') == null) ? $doctor->user->user : old('user') }}" class="form-control" name="user" id="user" placeholder="Usuario">
        {!! $errors->first('user', '<span class="help-block">:message</span>')  !!}
    </div>
    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
        <label for="password">Contraseña </label>
        <input type="password" value="{{ ($doctor && old('password') == null) ? "" : old('password') }}" class="form-control" name="password" id="password" placeholder="Contraseña">
        {!! $errors->first('password', '<span class="help-block">:message</span>')  !!}
    </div>

</div>


<div class="box-footer">
    <button type="submit" class="btn btn-primary btn-block">Guardar</button>
    <a href="{{ route('doctores.index') }}" class="btn btn-danger btn-block">Cancelar</a>
</div>

<!-- /.box -->