 <!-- general form elements -->
 
  <!-- /.box-header -->
  <!-- form start -->
  <div class="box-body">
    
    <div class="form-group {{ $errors->has('clinic_id') ? 'has-error' : '' }}">
        <label for="clinica_id">Clinica </label>
        <select name="clinic_id" class="form-control select2">
            @foreach ($clinicas as $clinica)
                @if ($empleado && $empleado->user->clinic_id == $clinica->id && old('clinic_id') == null)
                    <option selected value="{{ $clinica->id}}">{{ $clinica->nombre}}</option>
                @else
                    <option {{ old('clinic_id') == $clinica->id  ? 'selected' : "" }} value="{{ $clinica->id}}">{{ $clinica->nombre}}</option>
                @endif
                
            @endforeach

        </select>
        {!! $errors->first('clinic_id', '<span class="help-block">:message</span>')  !!}
    </div>

    <div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
        <label for="nombre">Nombre </label>
        <input type="text" value="{{ ($empleado && old('nombre') == null) ? $empleado->user->nombre : old('nombre') }}" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
        {!! $errors->first('nombre', '<span class="help-block">:message</span>')  !!}
    </div>

    <div class="form-group {{ $errors->has('apellidos') ? 'has-error' : '' }}">
        <label for="apellidos">Apellidos </label>
        <input type="text" value="{{ ($empleado && old('apellidos') == null) ? $empleado->user->apellidos : old('apellidos') }}" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos">
        {!! $errors->first('apellidos', '<span class="help-block">:message</span>')  !!}
    </div>
    
    <div class="form-group {{ $errors->has('telefono') ? 'has-error' : '' }}">
        <label for="telefono">Telefono </label>
        <input type="text" value="{{ ($empleado && old('telefono') == null) ? $empleado->user->telefono : old('telefono') }}" class="form-control" name="telefono" id="telefono" placeholder="Telefono">
        {!! $errors->first('telefono', '<span class="help-block">:message</span>')  !!}
    </div>

</div>
<!-- /.box -->