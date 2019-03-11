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
                    console.log('Valor seleccionado ' + date.format());
                    console.log('Vista seleccionado ' + view.name);
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
                         
                    // events: [
                    //     @forelse ($citas as $cita)
                    //         {
                    //             'id' : '{{ $cita->id}}',
                    //             'title' : '{{ $cita->asunto}}',
                    //             'start' :  '{{ $cita->fecha . " " . $cita->hora}}',
                    //             // 'color' : "red",
                    //             // 'textColor' : "white",
                    //         },
                    //     @empty
                            
                    //     @endforelse
                
                    // ],
                    // color: 'black',
                    // textColor: 'yellow', // an option!
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