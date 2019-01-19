 <!-- general form elements -->
 
  <!-- /.box-header -->
  <!-- form start -->
  <div class="box-body">
    
    <div class="form-group {{ $errors->has('clinic_id') ? 'has-error' : '' }}">
        <label for="clinica_id">Clinica </label>
        <select name="clinic_id" class="form-control select2">
            @foreach ($clinicas as $clinica)
                @if ($paciente && $paciente->user->clinic_id == $clinica->id && old('clinic_id') == null)
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
        <input type="text" value="{{ ($paciente && old('nombre') == null) ? $paciente->user->nombre : old('nombre') }}" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
        {!! $errors->first('nombre', '<span class="help-block">:message</span>')  !!}
    </div>

    <div class="form-group {{ $errors->has('apellidos') ? 'has-error' : '' }}">
        <label for="apellidos">Apellidos </label>
        <input type="text" value="{{ ($paciente && old('apellidos') == null) ? $paciente->user->apellidos : old('apellidos') }}" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos">
        {!! $errors->first('apellidos', '<span class="help-block">:message</span>')  !!}
    </div>

    <div class="form-group {{ $errors->has('correo') ? 'has-error' : '' }}">
        <label for="correo">Correo </label>
        <input type="email" value="{{ ($paciente && old('correo') == null) ? $paciente->user->correo : old('correo') }}" class="form-control" name="correo" id="correo" placeholder="Correo">
        {!! $errors->first('correo', '<span class="help-block">:message</span>')  !!}
    </div>
    
    <div class="form-group {{ $errors->has('telefono') ? 'has-error' : '' }}">
        <label for="telefono">Telefono </label>
        <input type="text" value="{{ ($paciente && old('telefono') == null) ? $paciente->user->telefono : old('telefono') }}" class="form-control" name="telefono" id="telefono" placeholder="Telefono">
        {!! $errors->first('telefono', '<span class="help-block">:message</span>')  !!}
    </div>
    
    <div class="form-group {{ $errors->has('fecha_naci') ? 'has-error' : '' }}">
        <label for="fecha_naci">Fecha Nacimiento </label>
        <input type="date" value="{{ ($paciente && old('fecha_naci') == null) ? $paciente->fecha_naci : old('fecha_naci') }}" class="form-control" name="fecha_naci" id="fecha_naci" placeholder="Fecha Nacimiento">
        {!! $errors->first('fecha_naci', '<span class="help-block">:message</span>')  !!}
    </div>

    <div class="form-group {{ $errors->has('sexo') ? 'has-error' : '' }}">
        <label for="sexo">Sexo </label>
        <select name="sexo" class="form-control select2">
            @if ($paciente && $paciente->sexo == "masculino" && old('sexo') == null)
                <option selected value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
            @elseif($paciente && $paciente->sexo == "femenino" && old('sexo') == null)
                <option selected value="femenino">Femenino</option>
                <option  value="masculino">Masculino</option>
            @else
                <option {{ old('sexo') == 'masculino'  ? 'selected' : "" }} value="masculino">Masculino</option>
                <option {{ old('sexo') == 'femenino'  ? 'selected' : "" }} value="femenino">Femenino</option>
            @endif
            
        </select>
        {!! $errors->first('sexo', '<span class="help-block">:message</span>')  !!}
    </div>
</div>
<!-- /.box -->