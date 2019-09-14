{{-- MODAL --}}

<div class="modal fade" id="modalCita" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
            
            <form>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-group">                            
                                <label for="paciente">Paciente</label>
                                <select class="form-control" name="paciente" id="paciente">
                                    
                                </select>
                            </div>
                        </div>
                                       
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                                <label for="doctor">Doctor</label>
                                <select class="form-control" name="doctor" id="doctor">
                                    
                                </select>
                        </div>
                                       
                    </div>
                </div>
                <div class="form-group">
                    <label for="asunto">Asunto</label>
                    <input type="text" class="form-control" id="asunto" placeholder="Asunto">
                </div>
                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <input type="text" class="form-control" id="observaciones" placeholder="Observaciones" required>
                </div>                
                <div class="form-group">
                    <label for="hora">Horario</label>
                    <input type="time" class="form-control" id="hora" required>
                </div>          
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" class="form-control" id="fecha">
                </div>      
                              
                
            </form>
        </div>
        <div class="modal-footer">
            {{-- <button type="button" class="btn btn-denger" data-dismiss="modal">Cancelar</button>
            <button type="button" id="btnGuardar" class="btn btn-primary">Guardar</button>
            <button type="button" id="btnEditar" class="btn btn-primary">Editar</button>
            <button type="button" id="btnEliminar" class="btn btn-danger">Eliminar</button> --}}
        </div>
        </div>
    </div>
</div><!-- /.modal -->