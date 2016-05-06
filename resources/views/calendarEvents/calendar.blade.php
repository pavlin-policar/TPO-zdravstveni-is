@extends('layouts.master')
@section('content')

    <!-- FullCalendar -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <script src='//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/lang/sl.js'></script>


    <div class="page-title">
        @can('canDoDoctoryStuff', App\Models\User::class)
            <span class="title">
                        Pregled terminov</span>
            <div class="description">Pregled prostih in zasedenih terminov</div>
            {!! link_to_route('calendar.schedule', 'Uredite svoj urnik', [], ['class' => 'btn btn-primary']) !!}
            <br />
            <br />
        @else
            <span class="title">
                Naročanje</span>
            <div class="description">Naročite se tako, da kliknete na prost termin</div>
        @endcan
    </div>

    <div id='calendar'>
        {!! $calendar->calendar() !!}
        {!! $calendar->script() !!}
    </div>

    <style>
        #calendar {
            width: 900px;
        }
    </style>
@endsection