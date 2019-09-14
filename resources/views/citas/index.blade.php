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
                loading: function(bool) {
                if (bool) {
                    console.log('Cargando') // show
                } else {
                    console.log('Termino de Cargar') // hide
                }
                },
                dayClick: function(date, jsEvent,view){
                    const dateSeleccionado = date.format();
                    
                    limpiarModal();
                    const modal = $("#modalCita");
                    modal.find('.modal-title').html("Nueva Cita");
                    modal.find('#fecha').val(dateSeleccionado).prop("disabled",true);

                    newCitaModal()
                        .then(data => {
                            const {doctores, pacientes} = data;
                            // console.log(doctores);
                            llenarSelectsModal(modal,doctores,pacientes)

                            modal.find('.modal-footer').html(`
                                <button type="button" id="btnGuardar" class="btn btn-primary">Guardar</button>
                                <button type="button" class="btn btn-denger" data-dismiss="modal">Cancelar</button>
                            `)
                            modal.modal();

                        })
                        .catch(err =>console.log(err))

                    
                },
                eventSources:[{      
                    events : function(start, end, timezone, callback) {
                        
                            $.ajax({
                                url: "{{ route('citas.index') }}",
                                dataType: 'json',
                                data: {                                        
                                    start: start.format(),
                                    end: end.format()
                                },
                                success: function(data) {   
                                    console.log(data);                                     
                                    const events = [];
                                    data.map(function(cita, index) {                                           
                                        events.push({
                                            id : cita.id,
                                            title : cita.patient.user.nombre,
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

                    getCitaAjax(id)
                        .then(res => {
                            // console.log(res);
                            const {cita,doctores,pacientes} = res;
                            limpiarModal();
                            modal.find('.modal-title').html("Editar Cita");
                            modal.find('form').append(`                                
                                <input type="hidden" class="form-control" id="_id" value="${id}">
                            `);

                            modal.find('#asunto').val(cita.asunto);
                            modal.find('#observaciones').val(cita.observaciones);
                            modal.find('#hora').val(cita.hora);
                            modal.find('#fecha').val(cita.fecha).prop("disabled",false);

                            llenarSelectsModal(modal,doctores,pacientes,cita);


                            modal.find('.modal-footer').html(`
                                <button type="button" id="btnActualizar" class="btn btn-primary">Actualizar</button>
                                <button type="button" id="btnEliminar" class="btn btn-danger">Eliminar</button>
                                <button type="button" class="btn btn-denger" data-dismiss="modal">Cancelar</button>
                            `)

                            modal.modal();
                        })
                        .catch(err => console.log(err))
                }

            });

            function limpiarModal() {
                const modal = $("#modalCita");
                modal.find("#doctor").html("");
                modal.find("#asunto").val("");
                modal.find("#observaciones").val("");
                modal.find("#paciente").html("");
                modal.find("#hora").val("");
                modal.find('#fecha').val('');
                modal.find('#_id') ? modal.find('#_id').remove() : '';
                limpiarAlertError(modal);
                
            }
            function limpiarAlertError(modal){
                let alertErrores = modal.find('.alert.alert-dismissible');
                if(alertErrores){
                    alertErrores.remove();
                }
            }

            //Click al guardar nueva cita
            $(document).on('click', '#btnGuardar',function(e){
                console.log("Guardando....")
                e.preventDefault();
                const modal = $("#modalCita");
                const urlToStore = "{{ route('citas.store') }}";
                const methodToStore= 'POST';
                
                const {data, errors} = getAndValidateFormNewCita(modal);
                limpiarAlertError(modal);

                if(errors.size > 0){
                    return mostrarErrores(errors,'danger', 'Errores');
                }

                storeOrUpdateCita(data,methodToStore,urlToStore)
                    .then( res => {
                        console.log(res);
                        $("#calendario").fullCalendar('refetchEvents');
                        modal.modal('toggle');
                    })
                    .catch((err) => {
                        console.log(err);
                        if(!err.responseJSON.success){
                            const {errors} = err.responseJSON; 
                            return mostrarErrores(new Map(Object.entries(errors)),'danger', 'Errores');
                        }
                    })
            });

            //Editar Cita
            $(document).on('click',"#btnActualizar",function(e){
                const modal = $("#modalCita");
                const idCitaToUpdate = modal.find('#_id').val() || null;
                const urlToUpdate = "{{ route('citas.store') }}" + `/${idCitaToUpdate}`;
                const methodToUpdate = "PUT";

                limpiarAlertError(modal);
                const {data, errors} = getAndValidateFormNewCita(modal);

                if(errors.size > 0){
                    return mostrarErrores(errors,'danger', 'Errores');
                }

                storeOrUpdateCita(data,methodToUpdate, urlToUpdate)
                    .then(res => {
                        console.log(res);
                        limpiarAlertError(modal);
                        mostrarErrores(new Map(Object.entries({
                                            succes: 'Cita editada con exito'
                                        })), 'success', 'Success');
                        $("#calendario").fullCalendar('refetchEvents');
                    })
                    .catch(err => {
                        const {statusText:error} = err;
                        return mostrarErrores(new Map(Object.entries({
                                            error: error
                                        })), 'danger', 'Errores');
                    })


            });

            $(document).on('click',"#btnEliminar",function(e){
                const modal = $("#modalCita");
                const idCitaToDelete = modal.find('#_id').val() || null;
                const urlToDelete = "{{ route('citas.store') }}" + `/${idCitaToDelete}`;
                const methodToDelete = "DELETE";

                limpiarAlertError(modal);

                storeOrUpdateCita({},methodToDelete, urlToDelete)
                    .then(res => {
                        $("#calendario").fullCalendar('refetchEvents');
                        modal.modal('toggle');
                    })
                    .catch(err => {
                        const {statusText:error} = err;
                        return mostrarErrores(new Map(Object.entries({
                                            error: error
                                        })), 'danger', 'Errores');
                    })
            });
            

            //Obtenemos los datos del formulario del modal y los validamos
            function getAndValidateFormNewCita(modal) {
                
                const data = {
                    'patient_id': modal.find('#paciente option:selected').val(),
                    'doctor_id': modal.find('#doctor option:selected').val(),
                    // 'paciente':40000,
                    // 'doctor': 9000000,
                    'asunto': modal.find('#asunto').val(),
                    'observaciones': modal.find('#observaciones').val(),
                    'hora': modal.find('#hora').val(),
                    'fecha': modal.find('#fecha').val(),
                }                               

                const errors = validateInputs(modal, data);

                return {data, errors};

                
            }
            


            //Validacion del modal
            function validateInputs(modalBody, data){                
                // const errors = {};
                const errors = new Map();


                const {patient_id,doctor_id,asunto,observaciones,hora,fecha} = data;

                if(!patient_id) errors.set('paciente','Debe selecionar un paciente');
                if(!doctor_id) errors.set('doctor','Debe selecionar un doctor');
                if(!asunto) errors.set('asunto','Debe describir el asunto');
                if(!observaciones) errors.set('observaciones','El campo observaciones esta vacio');
                if(!hora) errors.set('hora','Debe selecionar un hora');
                if(!fecha) errors.set('fecha','Debe selecionar un fecha');

                return errors;
            }

            //Mostrar errores
            function mostrarErrores(errors,typeModal,titleAlert){
                const modalBody = $("#modalCita .modal-body");
                
                let listaErrors = "";

                if(typeof errors === 'object'){    
                    errors.forEach((value,key,map) => {
                        console.log(Array.isArray(errors.get(key)));
                        if(Array.isArray(errors.get(key))){
                            listaErrors += `<li>${errors.get(key)[0]}</li>`;
                        }else {
                            listaErrors += `<li>${errors.get(key)}</li>`;
                        }                    
                    });
                    // Object.keys(errors).forEach(key => {
                    //     if(Array.isArray(key)){
                    //         listaErrors += `<li>${errors[key][0]}</li>`;
                    //     }else {
                    //         listaErrors += `<li>${errors[key]}</li>`;
                    //     }
                    //     console.log(errors[key]);
                }

                const ulErrors = `<ul>${listaErrors}</ul>`
                const alertError = ` <div class="alert alert-${typeModal} alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>${titleAlert}</strong>
                                        ${ulErrors}
                                    </div>`
                modalBody.prepend(alertError);
            }

            //Llenamos los select del modal para pacientes y Doctores
            function llenarSelectsModal(modal,doctores, pacientes,cita={}){
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
            }

            //Obtener una cita en especifico para actualizar
            function getCitaAjax(id){
                return $.ajax({
                    url: "{{  route('citas.getcita') }}",
                    type:'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    data:{
                        id,                           
                    },
                });
            }

            function newCitaModal(){
                return $.ajax({
                    url: "{{ route('citas.showcitamodal') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                });
            }

            function storeOrUpdateCita(data,method,url){
                return $.ajax({
                    url: url,
                    type: method,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    data: {...data}, 
                });
            }
        });
    </script> 
@endsection

