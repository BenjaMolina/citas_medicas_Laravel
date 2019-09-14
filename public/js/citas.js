$(document).ready(function() {
    $("#calendario").fullCalendar({
        header: {
            left: "title",
            right: "month,basicWeek,basicDay,today prev,next"
        },
        loading: function(bool) {
            if (bool) {
                console.log("Cargando"); // show
            } else {
                console.log("Termino de Cargar"); // hide
            }
        },
        dayClick: function(date, jsEvent, view) {
            const dateSeleccionado = date.format();

            limpiarModal();
            const modal = $("#modalCita");
            modal.find(".modal-title").html("Nueva Cita");
            modal
                .find("#fecha")
                .val(dateSeleccionado)
                .prop("disabled", true);

            newCitaModal()
                .then(data => {
                    const { doctores, pacientes } = data;
                    // console.log(doctores);
                    llenarSelectsModal(modal, doctores, pacientes);

                    modal.find(".modal-footer").html(`
                        <button type="button" id="btnGuardar" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-denger" data-dismiss="modal">Cancelar</button>
                    `);
                    modal.modal();
                })
                .catch(err => console.log(err));
        },
        eventSources: [
            {
                events: function(start, end, timezone, callback) {
                    $.ajax({
                        url: "{{ route('citas.index') }}",
                        dataType: "json",
                        data: {
                            start: start.format(),
                            end: end.format()
                        },
                        success: function(data) {
                            console.log(data);
                            const events = [];
                            data.map(function(cita, index) {
                                events.push({
                                    id: cita.id,
                                    title: cita.patient.user.nombre,
                                    start: `${cita.fecha} ${cita.hora}`,
                                    allDay: false
                                });
                            });
                            callback(events);
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    });
                }
            }
        ],
        eventClick: function(calEvent, jsEvent, view) {
            const { id } = calEvent;
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
                    const { cita, doctores, pacientes } = res;
                    limpiarModal();
                    modal.find(".modal-title").html("Editar Cita");
                    // modal.find('.modal-body').append(`
                    //     <div class="form-group">
                    //         <label for="fecha">Fecha</label>
                    //         <input type="date" class="form-control" id="fecha" placeholder="fecha">
                    //     </div>
                    // `);

                    modal.find("#asunto").val(cita.asunto);
                    modal.find("#observaciones").val(cita.observaciones);
                    modal.find("#hora").val(cita.hora);
                    modal.find("#fecha").val(cita.fecha);

                    llenarSelectsModal(modal, doctores, pacientes, cita);

                    modal.find(".modal-footer").html(`
                        <button type="button" id="btnActualizar" class="btn btn-primary">Actualizar</button>
                        <button type="button" id="btnEliminar" class="btn btn-danger">Eliminar</button>
                        <button type="button" class="btn btn-denger" data-dismiss="modal">Cancelar</button>
                    `);

                    modal.modal();
                })
                .catch(err => console.log(err));

            // modal.modal();
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
        limpiarAlertError(modal);
        // let fecha = modal.find('#fecha');
        // if(fecha){
        //     fecha.parent().remove();
        // }
    }
    function limpiarAlertError(modal) {
        let alertErrores = modal.find(".alert.alert-danger");
        if (alertErrores) {
            alertErrores.remove();
        }
    }

    //Click al guardar nueva cita
    $(document).on("click", "#btnGuardar", function(e) {
        console.log("Guardando....");
        e.preventDefault();
        const modal = $("#modalCita");
        const data = {
            patient_id: modal.find("#paciente option:selected").val(),
            doctor_id: modal.find("#doctor option:selected").val(),
            // 'paciente':40000,
            // 'doctor': 9000000,
            asunto: modal.find("#asunto").val(),
            observaciones: modal.find("#observaciones").val(),
            hora: modal.find("#hora").val(),
            fecha: modal.find("#fecha").val()
        };

        limpiarAlertError(modal);

        const errors = validateInputs(modal, data);

        if (Object.keys(errors).length > 0) {
            return mostrarErrores(errors);
        }
        storeNewCita(data)
            .then(res => {
                console.log(res);
            })
            .catch(err => {
                if (!err.responseJSON.success) {
                    const { errors } = err.responseJSON;
                    return mostrarErrores(errors);
                }
            });
    });

    //Editar Cita
    $("#btnActualizar").bind("click", function() {
        alert("clicked!");
    });

    //Validacion del modal
    function validateInputs(modalBody, data) {
        const errors = {};

        const {
            patient_id,
            doctor_id,
            asunto,
            observaciones,
            hora,
            fecha
        } = data;

        if (!patient_id) errors.paciente = "Debe selecionar un paciente";
        if (!doctor_id) errors.doctor = "Debe selecionar un doctor";
        if (!asunto) errors.asunto = "Debe describir el asunto";
        if (!observaciones)
            errors.observaciones = "El campo observaciones esta vacio";
        if (!hora) errors.hora = "Debe selecionar un hora";
        if (!fecha) errors.fecha = "Debe selecionar un fecha";

        return errors;
    }

    //Mostrar errores
    function mostrarErrores(errors) {
        const modalBody = $("#modalCita .modal-body");

        let listaErrors = "";

        Object.keys(errors).forEach(key => {
            if (Array.isArray(key)) {
                listaErrors += `<li>${errors[key][0]}</li>`;
            } else {
                listaErrors += `<li>${errors[key]}</li>`;
            }
            console.log(errors[key]);
        });

        const ulErrors = `<ul>${listaErrors}</ul>`;
        const alertError = ` <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Errores</strong>
                                ${ulErrors}
                            </div>`;
        modalBody.prepend(alertError);
    }

    //Llenamos los select del modal para pacientes y Doctores
    function llenarSelectsModal(modal, doctores, pacientes, cita = {}) {
        let doctorsSelect = ``,
            pacientesSelect = ``;

        doctores.map((doctor, index) => {
            doctorsSelect += `<option 
                        ${cita.doctor_id === doctor.id ? "selected" : ""} 
                        value="${doctor.id}">
                            ${doctor.user.nombre}
                        </option>`;
        });
        pacientes.map((paciente, index) => {
            pacientesSelect += `<option 
                        ${cita.patient_id == paciente.id ? "selected" : ""} 
                        value="${paciente.id}">
                            ${paciente.user.nombre}
                        </option>`;
        });
        modal.find("#doctor").html(doctorsSelect);
        modal.find("#paciente").html(pacientesSelect);
    }

    //Obtener una cita en especifico para actualizar
    function getCitaAjax(id) {
        return $.ajax({
            url: "{{  route('citas.getcita') }}",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            data: {
                id
            }
        });
    }

    function newCitaModal() {
        return $.ajax({
            url: "{{ route('citas.showcitamodal') }}",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }
        });
    }

    function storeNewCita(data) {
        console.log(data);
        return $.ajax({
            url: "{{ route('citas.store') }}",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            data: { ...data }
        });
    }
});
