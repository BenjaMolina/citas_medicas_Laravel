 <!-- general form elements -->
 
  <!-- /.box-header -->
  <!-- form start -->
  <div class="box-body">
    <div class="form-group {{ $errors->has('tipo_sangre') ? 'has-error' : '' }}">
        <label for="tipo_sangre">Tipo de Sangre </label>
        <input type="text" value="{{ ($paciente && old('tipo_sangre') == null) ? $paciente->tipo_sangre : old('tipo_sangre') }}" class="form-control" name="tipo_sangre" id="tipo_sangre" placeholder="Tipo de Sangre">
        {!! $errors->first('tipo_sangre', '<span class="help-block">:message</span>')  !!}
    </div>
    

    <div class="form-group {{ $errors->has('peso') ? 'has-error' : '' }}">
        <label for="peso">Peso </label>
        <input type="text" value="{{ ($paciente && old('peso') == null) ? $paciente->peso : old('peso') }}" class="form-control" name="peso" id="peso" placeholder="Peso">
        {!! $errors->first('peso', '<span class="help-block">:message</span>')  !!}
    </div>

    <div class="form-group {{ $errors->has('talla') ? 'has-error' : '' }}">
        <label for="talla">Talla </label>
        <input type="text" value="{{ ($paciente && old('talla') == null) ? $paciente->talla : old('talla') }}" class="form-control" name="talla" id="talla" placeholder="Talla">
        {!! $errors->first('talla', '<span class="help-block">:message</span>')  !!}
    </div>

    <div class="form-group {{ $errors->has('estatura') ? 'has-error' : '' }}">
        <label for="estatura">Estatura </label>
        <input type="text" value="{{ ($paciente && old('estatura') == null) ? $paciente->estatura : old('estatura') }}" class="form-control" name="estatura" id="estatura" placeholder="Estatura">
        {!! $errors->first('estatura', '<span class="help-block">:message</span>')  !!}
    </div>

    <div class="form-group {{ $errors->has('alergias') ? 'has-error' : '' }}">
        <label for="alergias">Alergias </label>
        <input type="text" value="{{ ($paciente && old('alergias') == null) ? $paciente->alergias : old('alergias') }}" class="form-control" name="alergias" id="alergias" placeholder="Alergias">
        {!! $errors->first('alergias', '<span class="help-block">:message</span>')  !!}
    </div>
    <div class="form-group {{ $errors->has('medicamentos') ? 'has-error' : '' }}">
        <label for="medicamentos">Medicamentos </label>
        <input type="text" value="{{ ($paciente && old('medicamentos') == null) ? $paciente->medicamentos : old('medicamentos') }}" class="form-control" name="medicamentos" id="medicamentos" placeholder="Medicamentos">
        {!! $errors->first('medicamentos', '<span class="help-block">:message</span>')  !!}
    </div>

    <div class="form-group {{ $errors->has('enfermedad') ? 'has-error' : '' }}">
        <label for="enfermedad">Enfermedades </label>
        <input type="text" value="{{ ($paciente && old('enfermedad') == null) ? $paciente->enfermedad : old('enfermedad') }}" class="form-control" name="enfermedad" id="enfermedad" placeholder="Enfermedad">
        {!! $errors->first('enfermedad', '<span class="help-block">:message</span>')  !!}
    </div>

</div>


<div class="box-footer">
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ route('pacientes.index') }}" class="btn btn-danger">Cancelar</a>
</div>

<!-- /.box -->