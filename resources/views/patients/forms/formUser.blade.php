 <!-- general form elements -->
 
  <!-- /.box-header -->
  <!-- form start -->
  <div class="box-body">
    <div class="form-group {{ $errors->has('correo') ? 'has-error' : '' }}">
        <label for="correo">Correo </label>
        <input type="email" value="{{ ($paciente && old('correo') == null) ? $paciente->user->correo : old('correo') }}" class="form-control" name="correo" id="correo" placeholder="Correo">
        {!! $errors->first('correo', '<span class="help-block">:message</span>')  !!}
    </div>
    
    <div class="form-group {{ $errors->has('user') ? 'has-error' : '' }}">
        <label for="user">Usuario </label>
        <input type="text" value="{{ ($paciente && old('user') == null) ? $paciente->user->user : old('user') }}" class="form-control" name="user" id="user" placeholder="Usuario">
        {!! $errors->first('user', '<span class="help-block">:message</span>')  !!}
    </div>
    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
        <label for="password">Contraseña </label>
        <input type="password" value="{{ ($paciente && old('password') == null) ? "" : old('password') }}" class="form-control" name="password" id="password" placeholder="Contraseña">
        {!! $errors->first('password', '<span class="help-block">:message</span>')  !!}
    </div>

</div>

<!-- /.box -->