{{-- MODAL --}}

<div class="modal fade" id="modalCita" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">{{ $titulo }}</h4>
        </div>
        <div class="modal-body">
            <p>One fine body&hellip;</p>
        </div>
        <div class="modal-footer">
            @if ($btn_guardar)
                <button type="button" class="btn btn-primary">{{ $btn_guardar }}</button>
            @endif
            @if ($btn_editar)
                <button type="button" class="btn btn-primary">{{ $btn_editar }}</button>
            @endif
            @if ($btn_eliminar)
                <button type="button" class="btn btn-danger">{{ $btn_eliminar }}</button>
            @endif

            <button type="button" class="btn btn-denger" data-dismiss="modal">Cancelar</button>
        </div>
        </div>
    </div>
</div><!-- /.modal -->