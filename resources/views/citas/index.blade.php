@extends('app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css">
      
@endsection

@section('content')
    @include('partials.content_header',[
        'header' => 'Citas',
        "description" => 'Citas medicas'
    ])

    <section class="content" >
        <div class="row">
            <div class="col-md-10 col-md-offset-1" style="background-color: white !important">
                <div id="calendario"></div>
            </div>
        </div>

        @include('partials.modal',[
            'titulo' => 'Agregar nueva cita',
            'route_guardar' => "{{ route('citas.store') }}",
            'btn_guardar' => 'Guardar',
            'route_editar' => null,
            'route_eliminar' => null,
            'btn_editar' => null,
            'btn_eliminar' => null,
        ])

    </section>
    
@endsection


@section('scripts')
    <script src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>  
    <script src="https://fullcalendar.io/js/fullcalendar-3.0.0/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.0.0/locale/es.js"></script>
    <script>
        $(document).ready(function(){
            $("#calendario").fullCalendar({
                header: {
                    left: 'title',
                    right: 'month,basicWeek,basicDay,today prev,next'

                },
                dayClick: function(date, jsEvent,view){
                    limpiarModal();
                    $('#modalCita').modal();
                },
                eventSources:[{      
                    events : function(start, end, timezone, callback) {
                            $.ajax({
                                url: "{{ route('citas.index') }}",
                                dataType: 'json',
                                data: {                                        
                                    start: start.unix(),
                                    end: end.unix()
                                },
                                success: function(data) {                                        
                                    const events = [];
                                    data.map(function(cita, index) {                                           
                                        events.push({
                                            id : cita.id,
                                            title : cita.asunto,
                                            start :  `${cita.fecha} ${cita.hora}`,
                                            allDay : false,
                                        });
                                    });
                                    callback(events);
                                },
                                error: function(err){
                                    console.log(err)
                                }
                            });
                    }                        
                    
                }],
                eventClick: function(calEvent, jsEvent,view){
                    const {id} = calEvent;
                    const modal = $("#modalCita");
                    const paciente = $("#paciente");
                    const doctor = $("#doctor");
                    const asunto = $("#asunto");
                    const observaciones = $("#observaciones");
                    const hora = $("#hora");
                    const fecha = $("#fecha");

                    getDataAjax(id)
                        .then(res => {
                            console.log(res);
                            const {cita,doctores,pacientes} = res;
                            modal.find('.modal-title').html("Editar Cita");

                            modal.find('#asunto').val(cita.asunto);
                            modal.find('#observaciones').val(cita.observaciones);
                            modal.find('#hora').val(cita.hora);
                            modal.find('#fecha').val(cita.fecha);

                            let doctorsSelect = ``, pacientesSelect = ``;

                            doctores.map((doctor,index) => {
                                doctorsSelect += 
                                        `<option 
                                            ${cita.doctor_id === doctor.id ? 'selected' : ''} 
                                            value="${doctor.id}">
                                                ${doctor.user.nombre}
                                            </option>`
                                
                                
                            });
                            pacientes.map((paciente,index) => {
                                pacientesSelect += 
                                        `<option 
                                            ${cita.patient_id== paciente.id ? 'selected' : ''} 
                                            value="${paciente.id}">
                                                ${paciente.user.nombre}
                                            </option>`
                                
                                
                            });
                            modal.find('#doctor').html(doctorsSelect);
                            modal.find('#paciente').html(pacientesSelect);
                            modal.find('.modal-footer').html(`
                                <button type="button" id="btnGuardar" class="btn btn-primary">Actualizar</button>
                                <button type="button" id="btnEliminar" class="btn btn-danger">Eliminar</button>
                                <button type="button" class="btn btn-denger" data-dismiss="modal">Cancelar</button>
                            `)
                        })
                        .catch(err => console.log(err))

                    

                    
                    modal.modal();
                }

            });

            function limpiarModal() {
                const modal = $("#modalCita");
                modal.find("#doctor").html("");
                modal.find("#asunto").val("");
                modal.find("#observaciones").val("");
                modal.find("#paciente").html("");
                modal.find("#hora").val("");
                modal.find("#fecha").val("");
            }

            function getDataAjax(id){
                return $.ajax({
                    url: "{{  route('citas.getcita') }}",
                    type:'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    data:{
                        id,                           
                    },
                    // success:(res) => {
                        

                    // },  
                    // error:(err) => {
                    //     console.log(err);
                    // }
                });
            }
        });
    </script>
@endsection

