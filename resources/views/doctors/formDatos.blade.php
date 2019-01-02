 <!-- general form elements -->
 
  <!-- /.box-header -->
  <!-- form start -->
  <div class="box-body">
    
    <div class="form-group {{ $errors->has('clinic_id') ? 'has-error' : '' }}">
        <label for="clinica_id">Clinica </label>
        <select name="clinic_id" class="form-control select2">
            @foreach ($clinicas as $clinica)
                @if ($doctor && $doctor->user->clinic_id == $clinica->id && old('clinic_id') == null)
                    <option selected value="{{ $clinica->id}}">{{ $clinica->nombre}}</option>
                @else
                    <option {{ old('clinic_id') == $clinica->id  ? 'selected' : "" }} value="{{ $clinica->id}}">{{ $clinica->nombre}}</option>
                @endif
                
            @endforeach

        </select>
        {!! $errors->first('clinic_id', '<span class="help-block">:message</span>')  !!}
    </div>

    <div class="form-group {{ $errors->has('area_id') ? 'has-error' : '' }}">
        <label for="area_id">Area </label>
        <select name="area_id" class="form-control select2">
            @foreach ($areas as $area)
            @if ($doctor && $doctor->area_id == $area->id && old('area_id') == null)
                <option selected value="{{ $area->id}}">{{ $area->nombre}}</option>
            @else
                <option {{ old('area_id') == $area->id ? 'selected' : "" }} value="{{ $area->id}}">{{ $area->nombre}}</option>
            @endif
                
            @endforeach

        </select>
        {!! $errors->first('area_id', '<span class="help-block">:message</span>')  !!}
    </div>

    <div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
        <label for="nombre">Nombre </label>
        <input type="text" value="{{ ($doctor && old('nombre') == null) ? $doctor->user->nombre : old('nombre') }}" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
        {!! $errors->first('nombre', '<span class="help-block">:message</span>')  !!}
    </div>

    <div class="form-group {{ $errors->has('apellidos') ? 'has-error' : '' }}">
        <label for="apellidos">Apellidos </label>
        <input type="text" value="{{ ($doctor && old('apellidos') == null) ? $doctor->user->apellidos : old('apellidos') }}" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos">
        {!! $errors->first('apellidos', '<span class="help-block">:message</span>')  !!}
    </div>
    
    <div class="form-group {{ $errors->has('telefono') ? 'has-error' : '' }}">
        <label for="telefono">Telefono </label>
        <input type="text" value="{{ ($doctor && old('telefono') == null) ? $doctor->user->telefono : old('telefono') }}" class="form-control" name="telefono" id="telefono" placeholder="Telefono">
        {!! $errors->first('telefono', '<span class="help-block">:message</span>')  !!}
    </div>

    <div class="form-group {{ $errors->has('cedula') ? 'has-error' : '' }}">
        <label for="cedula">Cedula </label>
        <input type="phone" value="{{ ($doctor && old('cedula') == null) ? $doctor->cedula : old('cedula') }}" class="form-control" name="cedula" id="cedula" placeholder="Cedula">
        {!! $errors->first('cedula', '<span class="help-block">:message</span>')  !!}
    </div>

    <div class="form-group {{ $errors->has('especialidad') ? 'has-error' : '' }}">
        <label for="especialidad">Especialidad </label>
        <input type="text" value="{{ ($doctor && old('especialidad') == null) ? $doctor->especialidad : old('especialidad') }}" class="form-control" name="especialidad" id="especialidad" placeholder="Especialidad">
        {!! $errors->first('especialidad', '<span class="help-block">:message</span>')  !!}
    </div>
</div>
<!-- /.box -->