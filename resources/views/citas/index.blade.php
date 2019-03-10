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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>  
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
                    console.log('Valor seleccionado ' + date.format());
                    console.log('Vista seleccionado ' + view.name);
                    $('#modalCita').modal();
                },
                eventSources:[{                
                    events: [
                        {
                            title  : 'event1',
                            start  : '2019-03-07',
                            descripcion: 'Cita con el lavandero'
                        },                    
                        {
                            title  : 'event1',
                            start  : '2019-03-07'
                        },
                        {
                            title  : 'event2',
                            start  : '2019-03-07',
                            end    : '2019-03-09'
                        },
                        {
                            title  : 'event_color',
                            // color: "#FF0F0",
                            // textColor: "white",
                            start  : '2019-03-10T12:30:00',
                            allDay : false // will make the time show
                        },
                        {
                            title  : 'event3',
                            start  : '2019-03-10T12:30:00',
                            allDay : false // will make the time show
                        },
                        
                    ],
                    // color: 'black',
                    // textColor: 'yellow',
                }],
                eventClick: function(calEvent, jsEvent,view){
                    console.log(calEvent);
                    console.log(calEvent.title);
                    console.log(calEvent.descripcion);

                    $('#modalCita').modal();
                }
            });
        });
    </script>
@endsection